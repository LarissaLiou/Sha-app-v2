const params = new URLSearchParams(window.location.search);
const conversation_id = params.get('conversation_id');
const messageInput = document.querySelector(".message_input")
const sendButton = document.querySelector(".send")
const messages = [{}]
var lastMessageContainer = null
if (!conversation_id) window.location.href = "index.php?filename=message"
var lastUpdated = 0;
function createMessage(message){
    var messageEle = createEle("div",["message"],null,{"innerText":message.content},null)
    if (messages[messages.length-1].sender_id == message.sender_id){
        lastMessageContainer.appendChild(messageEle)
    }
    else{
        var messageContainer = createEle("div",["user",message.is_you?"me":"other"],null,null,null)
        messageContainer.appendChild(messageEle)
        document.querySelector(".conversation").appendChild(messageContainer)
        lastMessageContainer = messageContainer
    }
    messages.push(message)
}

async function sendMessage(message){
    createMessage({
        "content": message,
        "sender_id": 1,
        "is_you": true
    })
    const response = await postRequest(
        "backend/Message/send_message.php",
        {
            "conversation_id": conversation_id,
            "content": message
        }
    )
    if (response.error){
        alert(response.error)
        return
    }
    lastUpdated = response.last_updated
}

async function setUp(){
    const messageData = await updateConversation()
    const profileEle = document.querySelector(".profile")
    const usernameEle = document.querySelector(".profile_user")
    profileEle.src = messageData.profile_picture
    usernameEle.innerText = messageData.username


}

async function updateConversation(){
    const messageData = await getRequest("backend/Message/get_conversation.php",{
        "conversation_id": conversation_id,
        "last_updated": lastUpdated
    })

    lastUpdated = messageData['last_updated']
    messageData['messages'].forEach(message => {
        createMessage(message)
    });
    return messageData
}
setUp()

sendButton.addEventListener("click",()=>{
    sendMessage(messageInput.value)
    messageInput.value = ""
}
)

setInterval(updateConversation,30000)