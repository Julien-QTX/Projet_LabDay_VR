let form = document.getElementById('lobby__form')

let displayName = sessionStorage.getItem('dislpay_name')

if(displayName) {
    form.name.value = displayName
}

form.addEventListener('submit', (e) => {

    e.preventDefault()

    sessionStorage.setItem('display_name', e.target.name.value)

    let inviteCode = e.target.room.value
    if(!inviteCode) {
        inviteCode = String(Math.floor(Math.random() * 10000))
    }

    window.location = `/?page=room&room=${inviteCode}`

})