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
        if(isNaN(xhr.responseText) || xhr.responseText == "") {
            console.log('h')
            errorMessage.style.display = "inline"
            errorMessage.innerText = "Cet utilisateur n'existe pas";
            errorMessage.classList.add("alert", "alert-error");
            errorMessage.style.color = "red";
            errorMessage.style.fontSize = "16px";
            errorMessage.style.textAlign = "center";
            errorMessage.style.margin = "5px 0"
        }
        else {
            errorMessage.style.display = "inline"
            errorMessage.innerText = "Demande envoyée";
            errorMessage.classList.add("alert", "alert-error");
            errorMessage.style.color = "green";
            errorMessage.style.fontSize = "16px";
            errorMessage.style.textAlign = "center";
            errorMessage.style.margin = "5px 0"
            //errorMessage.style.display = "none"
        }
    };
    xhr.send();
    e.target.reset()

})