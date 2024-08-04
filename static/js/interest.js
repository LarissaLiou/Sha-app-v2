let selected = new Array()

function selectCategory(){
    if (this.style.backgroundColor == 'white' || this.style.backgroundColor == '#e8e8e8'){
        this.style.backgroundColor = '#c2c2c2';
        selected.push(this.getElementsByClassName('text')[0].innerHTML)
        
    } else{
        this.style.backgroundColor = 'white'
        selected.splice(selected.indexOf(this.getElementsByClassName('text')[0].innerHTML), 1)
    }
    interest = document.getElementById('selectedInterest')
    interest.value = selected
}

function initialise(){ /*initialise the selectCategory function to selectables and make them white to prevent errors in selectCategory */
    var interests = document.getElementsByClassName('grid-items')
    for (interest of interests){
        interest.addEventListener('click', selectCategory)
        interest.style.backgroundColor = 'white'
    }
}

function removeAll(){
    interest = document.getElementById('selectedInterest')
}

window.onload = initialise
