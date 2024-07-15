


//check the password match the petterm
//(?=.\d) ensures that at least one digit is present.
//(?=.[a-z]) ensures that at least one lowercase letter is present.
//(?=.*[A-Z]) ensures that at least one uppercase letter is present.
//.{8,} ensures that the password is at least 8 characters long.
//if not match disable the login button
// document.querySelector(".inputPass").addEventListener('input', validate);
// document.querySelector(".login-btn").disabled = true;

// function validate() {
//     var inputPass = document.getElementById("inputPass").value;

//     if (!inputPass.match(RGEX)) {
//         document.querySelector(".login-btn").disabled = true;

//     } else {
//         document.querySelector(".login-btn").disabled = false;
//         document.querySelector(".inputPass").style.border = null;
//     }
// }



//login function check the user and password matching 
// document.querySelector(".login-btn").addEventListener('click', login);
// function login() {
//     var user = document.getElementById("inputUser").value;
//     var pass = document.getElementById("inputPass").value;
//     if (pass == localStorage.getItem(user)) {
//         alert("Logged In");
//         window.location.href = "./dealer/homepage.html";
//         // return false;
//     } else {
//         alert("wrong user/pass");
//         return false;
//     }
// }


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
let timer, timeoutVal = 500; // time it takes to wait for user to stop typing in ms
const kick = document.getElementById('check');
const typer1 = document.querySelector(".reg-username");
const typer2 = document.querySelector(".register-pass");
const typer3 = document.querySelector(".register-passRepeat");
const registerbtn = document.querySelector(".register-submit-btn");
registerbtn.disabled = true;

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
function handleKeyUp(e) {
    window.clearTimeout(timer); // prevent errant multiple timeouts from being generated
    timer = window.setTimeout(() => {
        let username = document.querySelector(".reg-username").value;
        let passrepeat1 = document.querySelector(".register-pass").value;
        let passrepeat2 = document.querySelector(".register-passRepeat").value;
        if (passrepeat1 == passrepeat2 && passrepeat2.match(RGEX)&&username !="") {
            kick.style.color = 'green';
            registerbtn.disabled = false;
        } else {
            kick.style.color = '#EA6549';
            registerbtn.disabled = true;
        }
    }, timeoutVal);
}



//save the password to the local storage

// function registerAC() {
//     if(registerbtn.disabled==false){
//         alert("Register");
//         let regusername = document.querySelector(".reg-username").value;
//         let regPass = document.querySelector(".register-pass").value;
//         localStorage.setItem(regusername, regPass);
//         sidebar1.classList.toggle('active');
//         sidebar2.classList.toggle('active');
//     }else{
//             alert("The password is not illegal!");
//         }

// }

// function onEnter(e){
//     if(e.keyCode == 13){
//        registerAC();
//     }
//   }