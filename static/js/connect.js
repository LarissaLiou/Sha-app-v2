const containers = document.querySelectorAll('.container');
let initialX = null, currentX = null;
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
  if (closest.type == "current") return;
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
  addNewCard
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

