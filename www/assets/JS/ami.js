let form = document.getElementsByClassName('bar')[0]
let input = document.getElementById('search')
let username = document.getElementById('username').innerText
let errorMessage = document.getElementById("p");

form.addEventListener('submit', function(e) {
    e.preventDefault()

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/www/actions/amis.php?action=add&other='+input.value);
    xhr.onload = () => {
        console.log(xhr.responseText)
        errorMessage.style.fontSize = "16px";
        errorMessage.style.textAlign = "center";
        errorMessage.style.margin = "5px 0"
        switch (xhr.responseText) {
            case 'Non-existent':
                errorMessage.innerText = "Cet utilisateur n'existe pas";
                errorMessage.style.display = "inline";
                errorMessage.style.color = "red";
                break;
            
            case 'Friends':
                errorMessage.innerText = "Vous êtes déjà amis";
                errorMessage.style.display = "inline";
                errorMessage.style.color = "red";
                break;
        
            default:
                errorMessage.innerText = "Demande envoyée";
                errorMessage.style.display = "inline"
                errorMessage.style.color = "green";
                break;
        }
    };
    xhr.send();
    e.target.reset()

})