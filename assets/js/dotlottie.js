// =========================================
// STRIDEX LOTTIE PRELOADER
// =========================================

window.addEventListener("load", function () {

    const preloader =
        document.getElementById("preloader");

    if (!preloader) return;

    setTimeout(function () {

        preloader.classList.add(
            "preloader-hidden"
        );

    }, 800);

});