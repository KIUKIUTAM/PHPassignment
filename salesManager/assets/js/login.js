
//swap between the login page and register page
let btn1 = document.querySelector("#close-btn");
let btn2 = document.querySelector("#loginSwap-btn");
let sidebar1 = document.querySelector(".wrapper-login");
let sidebar2 = document.querySelector(".wrapper-register");

console.log(btn2);
btn1.onclick = function () {
    sidebar1.classList.toggle('active');
    sidebar2.classList.toggle('active');
};
btn2.onclick = function () {
    sidebar1.classList.toggle('active');
    sidebar2.classList.toggle('active');
};



//keyup and Verify if the registered password matches the requested password.
let timer, timeoutVal = 1000; // time it takes to wait for user to stop typing in ms
const kick = document.getElementById('check');
const typer1 = document.querySelector(".reg-username");
const typer2 = document.querySelector(".register-pass");
const typer3 = document.querySelector(".register-passRepeat");
const registerbtn = document.querySelector(".register-submit-btn");

typer1.addEventListener('keypress', handleKeyPress);
typer1.addEventListener('keyup', handleKeyUp);
typer2.addEventListener('keypress', handleKeyPress);
typer2.addEventListener('keyup', handleKeyUp);
typer3.addEventListener('keypress', handleKeyPress);
typer3.addEventListener('keyup', handleKeyUp);
function handleKeyPress(e) {
    window.clearTimeout(timer);
    kick.style.color = 'unset';
}
var RGEX = /((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})/;
var EmailPattern =/([a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$)/;
registerbtn.disabled = true;
function handleKeyUp(e) {
    window.clearTimeout(timer); // prevent errant multiple timeouts from being generated
    timer = window.setTimeout(() => {
        let username = document.querySelector(".reg-username").value;
        let passrepeat1 = document.querySelector(".register-pass").value;
        let passrepeat2 = document.querySelector(".register-passRepeat").value;
        if (passrepeat1 == passrepeat2 && passrepeat2.match(RGEX)&&username.match(EmailPattern)) {
            kick.style.color = 'green';
            registerbtn.disabled = false;
        } else {
            kick.style.color = '#EA6549';
            registerbtn.disabled = true;
        }
    }, timeoutVal);
}


const forgot = document.querySelector('.forgot');
forgot.onclick = function () {
    if(confirm("How about buy some fish oil?")){
        var url = "https://www.mannings.com.hk/health/cardiovascular-health/fish-oil/c/feomega-3?lang=zh_TW";
            
            window.open(url, '_blank');
    }else{
        alert("You are not a fish oil lover");
    }
}