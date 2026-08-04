function togglePass(){

let p=
document.getElementById(
"password"
);

p.type=
p.type==="password"
?
"text"
:
"password";

}

function toggleConfirm(){

let p=
document.getElementById(
"confirm"
);

p.type=
p.type==="password"
?
"text"
:
"password";

}

const form=
document.querySelector(
"form"
);

form.addEventListener(
"submit",

function(e){

let password=
document
.getElementById(
"password"
)
.value;

let confirm=
document
.getElementById(
"confirm"
)
.value;

if(
password
!== 
confirm
){

e.preventDefault();

alert(
"Password does not match"
);

}

});

function togglePass(inputId, button) {

    const input = document.getElementById(inputId);

    if (input.type === "password") {

        input.type = "text";
        button.innerHTML = "🙈";

    } else {

        input.type = "password";
        button.innerHTML = "👁";

    }

}