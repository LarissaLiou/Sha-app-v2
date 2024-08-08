let selected2 = new Array()

function selectCategory2(){
    if (this.style.backgroundColor == 'white' || this.style.backgroundColor == '#e8e8e8'){
        this.style.backgroundColor = '#c2c2c2';
        selected2.push(this.innerHTML)
    } else{
        this.style.backgroundColor = 'white'
        selected2.splice(selected2.indexOf(this.innerHTML), 1)
    }
    skillsets = document.getElementById('selectedSkillset')
    skillsets.value = JSON.stringify(selected2)
}

function initialise(){ /*initialise the selectCategory function to selectables and make them white to prevent errors in selectCategory */
    var categories = document.getElementsByClassName('category')
    for (category of categories){
        category.addEventListener('click', selectCategory2)
        category.style.backgroundColor = 'white'
    }
}

window.onload = initialise
