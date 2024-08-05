const containers = document.querySelectorAll('.container');
let initialX = null, currentX = null;
var profileData = null
var currentProfile = null

function setUpInterests(container,interests){
  const interestContainer = container.querySelector(".interest-container")
  interestContainer.innerHTML = ""
  for (var interest of interests){
    const interestElement = createEle("div",["interest"],null,{"textContent":interest['interest']},{"backgroundColor":interest['color']})
    interestContainer.appendChild(interestElement)
  }
}
function setCard(container,profileNum){
  profileNum = (profileNum+profileData.length) % profileData.length
  console.log(profileNum)
  profile = profileData[profileNum]
  container.querySelector(".profile-img").src = profile.profile_picture
  container.querySelector(".profile-img").onerror = () => {
    container.querySelector(".profile-img").src = "static/assets/default.png"
  }
  container.querySelector(".name").textContent = profile.username
  container.querySelector(".location").textContent = profile.location
  container.querySelector(".about").textContent = profile.about
  container.querySelector(".view").onclick = () => {
    window.location.href = `index.php?filename=${profile.user_id}`
  }
  container.querySelector(".connect").onclick = async function(){
    console.log(profile.user_id)
    console.log("Ran")
    this.innerText = "Connecting..."
    const response = await postRequest("backend/Connect/connect.php",{"user_id":profile.user_id})
    if (response.success){
      this.innerText = "Requested!"
      this.disabled = true
    }
    else{
      this.innerText = response.error
    }
  }
  setUpInterests(container,profile.interests)
}

function setUpAllCards(currentProfile){
  setCard(containers[0],currentProfile-1)
  setCard(containers[1],currentProfile)
  setCard(containers[2],currentProfile+1)
}
async function setUp(){
  const {profiles} = await getRequest("backend/Connect/recommendations.php",{"count":100})
  console.log(profiles)
  profileData = profiles
  currentProfile = Math.floor(profileData.length/2)
  setUpAllCards(currentProfile)
}


function dragStart(event) {
    initialX = event.clientX || event.touches[0].clientX;
    for (var container of containers) {
        container.style.transition = 'none';
    }
}
function dragEventListener(event) {
    if (initialX === null) return
    currentX = event.clientX || event.touches[0].clientX;
    const x = currentX - initialX ;
    const center = window.innerWidth / 2;
  for (var container of containers) {
    
    const rect = container.getBoundingClientRect();
    const containerCenter = rect.left + rect.width / 2;
    const distance = Math.abs(center - containerCenter);
    const currentness = 1 - (distance / ((1/0.5) *center)) * 0.5;
    container.style.setProperty('--currentness', currentness);
    container.style.setProperty('--shift', `${x}px`)
  }
}

function findClosest() {
  const center = window.innerWidth / 2;
  const distances = Array.from(containers).map(container => {
      const rect = container.getBoundingClientRect();
      const containerCenter = rect.left + rect.width / 2;
      return Math.abs(center - containerCenter);
  });
  const minDistance = Math.min(...distances);
  const curContainer = containers[distances.indexOf(minDistance)];
  // Assuming classes 'before', 'current', 'after' are directly set on elements
  const types = [
    "before",
    "current",
    "after"
  ]
  for (let classOf of curContainer.classList) {
      if (types.includes(classOf)){
        return {
          container: curContainer,
          type: classOf
        }
      }
  }
  return null; // Return null if no matching class found
}

function reassignClasses(closest) {
  const toMoveList = {
    "before":{
      "before":"current",
      "current":"after",
      "after":"before"
    },
    "after":{
      "after":"current",
      "current":"before",
      "before":"after"
    }
  }
  const closestType = closest.type
  containers.forEach(container => {
    // Re-enable transition for smooth return to place or snap to grid
    container.style.transition = 'transform 0.3s ease-out, opacity 0.3s ease-out, margin-top 0.3s ease-out';
    // Assume we snap back to the start or another defined position
    container.style.setProperty('--shift', `0px`)
    if (container == closest.container) {
      container.style.setProperty('--currentness', 1)
    }
    else {
      container.style.setProperty("--currentness",0.5)
    }
  });  
  if (closestType == "current") return;
  const usedList = toMoveList[closest.type]
  containers.forEach(container =>{
    for (var classOf of container.classList){
      if (usedList[classOf] == null) continue 
      container.classList.add(usedList[classOf])
      container.classList.remove(classOf)
      if (usedList[classOf] == closest.type){
        container.style.transition = '';
        addNewCard({container,newType:usedList[classOf]})
      }
      break 
    }
  })

  if (closestType == "before"){
    currentProfile--  
  }
  else{
    currentProfile++
  }
  currentProfile %= profileData.length
  setUpAllCards(currentProfile)

}

function addNewCard(container){
  container.container.classList.remove("fadeFromRight")
    container.container.classList.remove("fadeFromLeft")
  container.container.offsetWidth
  if (container.newType == "after"){
        container.container.classList.add("fadeFromRight")
  }
  else{
    container.container.classList.add("fadeFromLeft")
  }
  // retrigger animation
  
}

function dragStop(event){
  console.log(event)
  initialX = null;
  const closest = findClosest()
  reassignClasses(closest)
  

}
document.addEventListener("mousedown",dragStart)
document.addEventListener("mousemove",dragEventListener)
document.addEventListener("touchstart",dragStart)
document.addEventListener("touchmove",dragEventListener)
document.addEventListener("mouseup",dragStop)
document.addEventListener("touchend",dragStop)

setUp()