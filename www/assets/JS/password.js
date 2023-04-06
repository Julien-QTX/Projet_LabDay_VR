// function to show and hide password in login and register page
let passEye = document.getElementById('pass-eye');
let cpassEye = document.getElementById('cpass-eye');
let pass = document.getElementById('password');
let cpass = document.getElementById('cpassword');

passEye.addEventListener("click", () => {
    switchEye(passEye, pass);
});
cpassEye.addEventListener("click", () => {
    switchEye(cpassEye, cpass);
});

function switchEye(eye, input) {
    console.log(eye.src)
    if (eye.src.includes("ceye2")) {
        console.log('was open')
        eye.src = "assets/images/oeye2.png";
        input.type = 'text'
    }
    else {
        console.log('was closed')
        eye.src = "assets/images/ceye2.png";
        input.type = 'password'
    }
}