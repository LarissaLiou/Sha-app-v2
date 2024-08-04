let events = document.getElementsByClassName('discoverimage');
for (eventa of events){
    eventa.addEventListener('mouseover', hover)
    eventa.addEventListener('click', redirectEvent)
}

function hover(){
    this.style.cursor = "pointer";
}

function redirectEvent(){
    window.location.href = "index.php?filename=eventInformation"
}

console.log('hello')