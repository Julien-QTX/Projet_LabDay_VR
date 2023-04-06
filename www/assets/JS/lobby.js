let form = document.getElementById('join-form')
let background_selection = document.getElementById('background_selection')
let createBtn = document.getElementById('create')
let joinBtn = document.getElementById('join')
let submitBtn = document.getElementById('submit-btn')
let roomIdSelect = document.getElementById('room-id')
let bgSlct = document.getElementById('bg-slct')

let inviteLink = document.getElementsByName('invite_link')[0]

let action = 'create'

createBtn.style.backgroundColor = '#03E9F4'
roomIdSelect.style.display = 'none'
inviteLink.removeAttribute('required')

// Show create room form when create button is pressed
createBtn.addEventListener('click', function() {
    joinBtn.style.backgroundColor = '#141e30'
    createBtn.style.backgroundColor = '#03E9F4'
    submitBtn.value = 'Créer un salon'
    bgSlct.style.display = 'block'
    roomIdSelect.style.display = 'none'
    inviteLink.removeAttribute('required')
    action = 'create'
})

// Show join room form when join button is pressed
joinBtn.addEventListener('click', function() {
    createBtn.style.backgroundColor = '#141e30'
    joinBtn.style.backgroundColor = '#03E9F4'
    submitBtn.value = 'Rejoindre un salon'
    bgSlct.style.display = 'none'
    roomIdSelect.style.display = 'block'
    inviteLink.setAttribute('required', '')
    action = 'join'
})

inviteLink.addEventListener('input', function() {
    inviteLink.value = inviteLink.value.toUpperCase()
})


form.addEventListener('submit', (e) => {
    e.preventDefault()
    let background = background_selection.value

    if (action == 'create') {
        //Create a new room in database
        const xhr = new XMLHttpRequest();
        const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let randomString = '';
        for (let i = 0; i < 6; i++) {
        const index = Math.floor(Math.random() * characters.length);
        randomString += characters[index];
        }
        xhr.open('POST', '/actions/rooms.php?action=add&room='+randomString+'&background='+background);
        xhr.onload = () => {
            window.location.href = `/?page=call&room=${randomString}&background=${background}`
        };
        xhr.send();

    }
    else {
        //Join an existing room
        const xhr = new XMLHttpRequest();
        console.log(inviteLink.value)

        var bg = ""
        
        //check if room exists
        xhr.open('GET', '/actions/rooms.php?action=show&room='+inviteLink.value);
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.includes('<')) {
                    //display error message if room doesn't exist
                    var errorMessage = document.getElementById("p");
                    errorMessage.innerText = "Ce salon n'existe pas";
                    errorMessage.classList.add("alert", "alert-error");
                    errorMessage.style.color = "red";
                    errorMessage.style.fontSize = "16px";
                    errorMessage.style.textAlign = "center";
                }
                else {
                    bg = xhr.responseText
                    window.location = `/?page=call&room=${inviteLink.value}&background=${bg}`
                }
            };
        }
        xhr.send();
        
    }
})

// Lists of possible backgrounds
let validBackgrounds = ["contact", "egypt", "checkerboard", "forest", "goaland", "yavapai", "goldmine", "threetowers", "poison", "arches", "tron", "japan", "dream", "volcano", "starry", "osiris", "moon"]

//add options to background selection
for (let i = 0; i < validBackgrounds.length; i++) {
    
    let cases = document.createElement('option')
    cases.setAttribute('value', validBackgrounds[i])
    let string = validBackgrounds[i]
    string = string.charAt(0).toUpperCase() + string.slice(1);
    cases.innerText = string
    background_selection.append(cases)
    
}