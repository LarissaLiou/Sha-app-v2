const event_container = document.querySelector("#events")

function insertEvent(eventData){
    const event = document.createElement("div")
    for (const key in eventData){
        event.dataset[key] = JSON.stringify(eventData[key])
    }
    event.classList.add("event")
    const img = document.createElement("img")
    img.classList.add("event_picture")
    img.src = eventData.image
    img.onerror = function(){
        img.src = "static/assets/default.png"
    }
    event.appendChild(img)
    const title = document.createElement("h3")
    title.classList.add("event_name")
    title.textContent = eventData.event_name
    event.appendChild(title)
    event_container.appendChild(event)
}

function insertUser(userData){
    const profile = document.createElement("div")
    for (const key in userData){
        profile.dataset[key] = JSON.stringify(userData[key])
    }
    profile.classList.add("profile")
    const img = document.createElement("img")
    img.classList.add("profile_picture")
    img.src = userData.profile_picture
    img.onerror = function(){
        img.src = "static/assets/default.png"
    }
    profile.appendChild(img)
    const username = document.createElement("h3")
    username.classList.add("profile_username")
    username.textContent = userData.username
    profile.appendChild(username)
    const handle = document.createElement("p")
    handle.classList.add("profile_handle")
    handle.textContent = userData.user_handle
    profile.appendChild(handle)
    profiles_container.appendChild(profile)
}
async function setUp(){
    const {users,events} = await getRequest("backend/Search/getData.php")
    
    for (const user of users){
        insertUser(user)
    }
    for (const event of Object.values(events)){
        insertEvent(event)
    }
}

function search(){
    var search_term = this.value.toLowerCase()
    const events = document.querySelectorAll(".event")
    const profiles = document.querySelectorAll(".profile")
    for (const event of events){
        if (event.dataset.event_name.toLowerCase().includes(search_term)) event.style.display = "block"
        else event.style.display = "none"
    }
    for (const profile of profiles){
        if (profile.dataset.username.toLowerCase().includes(search_term) || profile.dataset.user_handle.toLowerCase().includes(search_term)) profile.style.display = "block"
        else profile.style.display = "none"
    }
}
setUp()
search_input.addEventListener("input",search)