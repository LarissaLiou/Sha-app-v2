var profileId = 2;
async function sendMessageRequest(ele){
    ele.innerText = "Sending..."
    var response = await postRequest("backend/Message/send_message_request.php",{"user_id":profileId})
    if (response.success){
        ele.innerText = "Sent Request!"
        ele.disabled = true
    }
    else{
        ele.innerText = response.error
    }
}