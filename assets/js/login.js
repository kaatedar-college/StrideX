function togglePass(){

let p = document.getElementById("password");

p.type=
p.type=== "password"
?
"text"
:
"password";

}

///////////////////////////////
/// for reset password page ///
///////////////////////////////

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

