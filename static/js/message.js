const requestContent = document.getElementById('requestContent')
const messageContent = document.getElementById('messageContent')
function switchTab(){
    let buttons = document.getElementsByClassName('button')
    for (let button of buttons){
        if (button.id != 'event'){
            button.style.border = '0px solid black'
            button.style.color = 'black'
            button.style.backgroundColor = '#d9d9d9'
        }   
    }

    this.style.border = '2px solid #FBBF3B'
    this.style.color = '#FBBF3B'
    this.style.backgroundColor = 'rgba(91, 192, 190, 0.16)'

    if (this.id == "message"){
        requestContent.style.display = 'none'
        messageContent.style.display = 'flex'
    } else if (this.id == 'request'){ //add eventContent visibility after it is built
        messageContent.style.display = 'none'
        requestContent.style.display = 'flex'
    }
}
function addRequest(request){
    const requestContainer = createEle('div',['requestGrid'])
    const img = createEle('img',["messagePfp","eachPerson","grid-items"],null,{src:request['profile_picture']})
    img.onerror = function(){
        this.src = "static/assets/default.png"
    }
    requestContainer.dataset.request_id = request['request_id']
    const name = createEle('p',['requestName','grid-items'],null,{"innerText":request.username},{})
    const acceptButton = createEle('button',['requestAccept'],null,{"innerText":"Accept"},{})
    const declineButton = createEle('button',['requestDecline'],null,{"innerText":"Decline"},{})
    requestContainer.appendChild(img)
    requestContainer.appendChild(name)
    requestContainer.appendChild(acceptButton)
    requestContainer.appendChild(declineButton)
    requestContent.appendChild(requestContainer)

    acceptButton.addEventListener('click', async function(){
        var request_id = this.parentElement.dataset.request_id
        const response = await postRequest("backend/Message/accept_reject_message_request.php",{"request_id":request_id, "action":"accept"})
        if (response['success']){
            requestContainer.remove()
        }
        else{
            alert(response['error'])
        }
    })

    declineButton.addEventListener('click', async function(){
        var request_id = this.parentElement.dataset.request_id
        const response = await postRequest("backend/Message/accept_reject_message_request.php",{"request_id":request_id, "action":"reject"})
        if (response['success']){
            requestContainer.remove()
        }
        else{
            alert(response['error'])
        }
    })
}

function addMessage(message){
    const messageGrid = createEle('div',['messageGrid'])
    const img = createEle('img',["messagePfp","eachPerson","grid-items"],null,{src:message['profile_picture']})
    img.onerror = function(){
        this.src = "static/assets/default.png"
    }
    const name = createEle('p',['messageName','grid-items'],null,{"innerText":message.username},{})
    const preview = createEle('p',['messagePreview','grid-items'],null,{"innerText":message.last_message},{})
    messageGrid.appendChild(img)
    messageGrid.appendChild(name)
    messageGrid.appendChild(preview)
    messageContent.appendChild(messageGrid)

    messageGrid.addEventListener('click', function(){
        window.location.href = `index.php?filename=messageEach&conversation_id=${message['conversation_id']}`
    })
}

async function initialiseRequests(){
    const response = await getRequest("backend/Message/get_message_requests.php")
    for (const request of response['requests']){
        addRequest(request)
    }
}

async function initialiseMessages(){
    const response = await getRequest("backend/Message/get_conversations.php")
    for (const message of response['conversations']){
        addMessage(message)
    }
}

function initialise(){
    requestContent.style.display = 'none'
    initialiseRequests()
    initialiseMessages()
}

function redirect(){
    window.location.href = "index.php?filename=messageEach";
}

let buttons = document.getElementsByClassName('button')
for (let button of buttons) {
    button.addEventListener('click', switchTab)
}

let messages = document.getElementsByClassName('messageGrid')
for (let message of messages){
    message.addEventListener('click', redirect)
}

window.onload = initialise()