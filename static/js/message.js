function switchTab(){
    let buttons = document.getElementsByClassName('button')
    for (let button of buttons){
        if (button.id != 'event'){
            button.style.border = '0px solid black'
            button.style.color = 'black'
            button.style.backgroundColor = '#d9d9d9'
        }   
    }

    this.style.border = '2px solid #5BC0BE'
    this.style.color = '#5BC0BE'
    this.style.backgroundColor = 'rgba(91, 192, 190, 0.16)'

    if (this.id == "message"){
        messageContent = document.getElementById('messageContent')
        requestContent.style.display = 'none'
        messageContent.style.display = 'block'
    } else if (this.id == 'request'){ //add eventContent visibility after it is built
        requestContent = document.getElementById('requestContent')
        messageContent.style.display = 'none'
        requestContent.style.display = 'block'
    }
}

function initialise(){
    requestContent.style.display = 'none'
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