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
    if (eye.classList.value.includes("fa-eye-slash")) {
        eye.classList.remove('fa-eye-slash')
        eye.classList.add('fa-eye')
        input.type = 'text'
    }
    else {
        eye.classList.remove('fa-eye')
        eye.classList.add('fa-eye-slash')
        input.type = 'password'
    }
}