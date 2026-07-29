const inputs = document.querySelectorAll(".otp-input");
const hiddenOTP = document.getElementById("finalOTP");

const verifyBtn = document.querySelector(".verify-btn");    

let submitted = false;

inputs.forEach((input, index) => {

    input.addEventListener("input", function () {

        // Sirf number allow
        this.value = this.value.replace(/\D/g, "");

        // Next box
        if (this.value !== "" && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }

        updateOTP();

    });

    input.addEventListener("keydown", function (e) {

        if (e.key === "Backspace" && this.value === "" && index > 0) {
            inputs[index - 1].focus();
        }

    });

});

function updateOTP() {

    let otp = "";

    inputs.forEach(input => {
        otp += input.value;
    });

    hiddenOTP.value = otp;

    console.log("OTP =", otp);
    console.log("Length =", otp.length);
    console.log("submitted =", submitted);

    if (otp.length === inputs.length && !submitted) {

        console.log("INSIDE IF");

        submitted = true;

        verifyBtn.innerHTML = "Verifying...";
        verifyBtn.disabled = true;

        document.getElementById("otpForm").requestSubmit();
    }

}

/////////////////////////
//// OTP Countdown Timer
/////////////////////////

let timeLeft = 60;

const countdown = document.getElementById("countdown");
const resendLink = document.getElementById("resendLink");
const resendText = document.querySelector(".resend-text");

const timer = setInterval(function () {

    timeLeft--;

    countdown.textContent = timeLeft;

    if (timeLeft <= 0) {

        clearInterval(timer);

        resendText.style.display = "none";

        resendLink.style.display = "block";

    }

}, 1000);

/////////////////////////////
///OTP paste in all boxes///
///////////////////////////
inputs.forEach((input) => {

    input.addEventListener("paste", function (e) {

        e.preventDefault();

        const pastedData = (e.clipboardData || window.clipboardData)
            .getData("text")
            .replace(/\D/g, "");

        if (pastedData.length === inputs.length) {

            inputs.forEach((box, index) => {

                box.value = pastedData[index];

            });

            updateOTP();

            inputs[inputs.length - 1].focus();

        }

    });

});

// ===============================
// Invalid OTP Animation
// ===============================

const errorBox = document.getElementById("otpError");

// if (errorBox) {

//     const otpBoxes = document.querySelector(".otp-boxes");

//     otpBoxes.classList.add("otp-invalid");

// }

//////////////////////////////////
// Resend OTP Click
//////////////////////////////////

resendLink.addEventListener("click", function (e) {

    e.preventDefault();

    resendLink.style.display = "none";
    resendText.style.display = "block";

    fetch("../php/resend_otp.php")

    .then(response => response.text())

    .then(data => {

        data = data.trim();

        if (data === "success") {

            timeLeft = 60;

            countdown.textContent = timeLeft;

            const timer = setInterval(function () {

                timeLeft--;

                countdown.textContent = timeLeft;

                if (timeLeft <= 0) {

                    clearInterval(timer);

                    resendText.style.display = "none";

                    resendLink.style.display = "block";

                }

            }, 1000);

        } else {

            alert(data);

            resendText.style.display = "none";

            resendLink.style.display = "block";

        }

    })

    .catch(error => {

        console.error(error);

        alert("Something went wrong.");

        resendText.style.display = "none";

        resendLink.style.display = "block";

    });

});