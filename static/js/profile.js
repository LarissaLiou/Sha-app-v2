const urlParams = new URLSearchParams(window.location.search);
const user_id = urlParams.get('user_id');
if (!user_id){
    window.location.href = "index.php"
}
async function sendMessageRequest(ele){
    ele.innerText = "Sending..."
    var response = await postRequest("backend/Message/send_message_request.php",{"user_id":user_id})
    if (response.success){
        ele.innerText = "Sent Request!"
        ele.disabled = true
    }
    else{
        ele.innerText = response.error
    }
}
async function sendConnectionRequest(ele){
    var response = await postRequest("backend/Connect/connect.php",{"user_id":user_id})
    if (response.success){
        alert("Connection Request Sent!")
    }
    else{
        alert(response.error)
    }
}
function fillInterests(interests){
    const interestContainer = document.getElementById("interests_container")
    for (const interest of interests){
        const interestEle = createEle("span",["interestBlocks","background1"],null,{"textContent":interest.interest},{"backgroundColor":interest.color,"color":"white"})
        interestContainer.appendChild(interestEle)
    }
}
function fillProfile(profileData){
    const connectionCountEle = document.getElementById("connection_count")
    const name = document.getElementById("personName")
    const tag = document.getElementById("personTag")
    const country = document.getElementById("personCountry")
    const state = document.getElementById("personState")
    const profileEle = document.getElementById("pfp")
    const aboutInput = document.getElementById("about_input")
    connectionCountEle.textContent = profileData.connection_count??0
    name.textContent = profileData.username
    tag.textContent = '@'+profileData.user_handle
    country.textContent = profileData.country
    state.textContent = profileData.city 
    aboutInput.value = profileData.about
    fillInterests(profileData.interests)
    profileEle.src = profileData.profile_picture
    profileEle.onerror = function(){
        this.src = "static/assets/default.png"
    }

}

function handleIfSelf(){
    const actionButtons = document.querySelector(".gridicons")
    actionButtons.style.display = "none"
    const logoutButton = document.getElementById("logout_button")
    logoutButton.style.display = "block"
    const aboutInput = document.getElementById("about_input")
    aboutInput.contentEditable = true
    aboutInput.disabled = false
    const saveButton = document.getElementById("edit_about")
    saveButton.style.display = "block"
    
}
async function setUp(){
    const profileData = await getRequest("backend/Profile/get_profile.php",{"user_id":user_id})
    fillProfile(profileData['user'])
    if (profileData['user']['is_self']){
        handleIfSelf()
    }
}

async function editAbout(ele){
    const aboutInput = document.getElementById("about_input")
    const response = await postRequest("backend/Profile/edit_about.php",{"about":aboutInput.value})
    if (response.success){
        ele.innerText = "Saved!"
        setTimeout(()=>{ele.innerText = "Edit"},1000)
    }
    else{
        alert(response.error)
    }
}
setUp()