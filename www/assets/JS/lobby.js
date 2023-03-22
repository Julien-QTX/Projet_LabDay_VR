let form = document.getElementById('join-form')
let background_selection = document.getElementById('background_selection')
let createBtn = document.getElementById('create')
let joinBtn = document.getElementById('join')
let submitBtn = document.getElementById('submit-btn')
let bgSlct = document.getElementById('bg-slct')

createBtn.style.backgroundColor = '#03E9F4'

createBtn.addEventListener('click', function() {
    joinBtn.style.backgroundColor = '#141e30'
    createBtn.style.backgroundColor = '#03E9F4'
    submitBtn.value = 'Créer un salon'
    bgSlct.style.display = 'block'
})

joinBtn.addEventListener('click', function() {
    createBtn.style.backgroundColor = '#141e30'
    joinBtn.style.backgroundColor = '#03E9F4'
    submitBtn.value = 'Rejoindre un salon'
    bgSlct.style.display = 'none'
})


form.addEventListener('submit', (e) => {
    e.preventDefault()
    let inviteCode = e.target.invite_link.value
    let background = background_selection.value
    window.location = `/?page=call&room=${inviteCode}&background=${background}`
})

// Liste des environnements possibles
let validBackgrounds = ["contact", "egypt", "checkerboard", "forest", "goaland", "yavapai", "goldmine", "threetowers", "poison", "arches", "tron", "japan", "dream", "volcano", "starry", "osiris", "moon"]

for (let i = 0; i < validBackgrounds.length; i++) {
    
    let cases = document.createElement('option')
    cases.setAttribute('value', validBackgrounds[i])
    let string = validBackgrounds[i]
    string = string.charAt(0).toUpperCase() + string.slice(1);
    cases.innerText = string
    background_selection.append(cases)
    
}

