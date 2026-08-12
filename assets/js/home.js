document.addEventListener("DOMContentLoaded", () => {

    /* =====================================
       NAVBAR
    ===================================== */

    const navbar =
        document.querySelector(".navbar");

    window.addEventListener("scroll", () => {

        if (window.scrollY > 30) {

            navbar.classList.add("scrolled");

        } else {

            navbar.classList.remove("scrolled");

        }

    });


    /* =====================================
       SMOOTH SCROLL
    ===================================== */

    document
        .querySelectorAll('a[href^="#"]')
        .forEach((link) => {

            link.addEventListener("click", (event) => {

                const id =
                    link.getAttribute("href");

                if (!id || id === "#") {
                    return;
                }

                const target =
                    document.querySelector(id);

                if (target) {

                    event.preventDefault();

                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });

                }

            });

        });


    /* =====================================
       HERO PARALLAX
    ===================================== */

    const heroVisual =
        document.querySelector(".hero-visual");

    if (heroVisual) {

        document.addEventListener(
            "mousemove",
            (event) => {

                if (window.innerWidth < 1050) {
                    return;
                }

                const x =
                    (window.innerWidth / 2 -
                    event.clientX) / 80;

                const y =
                    (window.innerHeight / 2 -
                    event.clientY) / 80;

                heroVisual.style.transform =
                    `translate(${x}px, ${y}px)`;

            }
        );

        document.addEventListener(
            "mouseleave",
            () => {

                heroVisual.style.transform =
                    "translate(0, 0)";

            }
        );

    }


    /* =====================================
       SCROLL REVEAL
    ===================================== */

    const revealItems =
        document.querySelectorAll(
            ".feature-card, .category-item"
        );

    const observer =
        new IntersectionObserver(
            (entries) => {

                entries.forEach((entry) => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            "visible"
                        );

                        observer.unobserve(
                            entry.target
                        );

                    }

                });

            },
            {
                threshold: 0.15
            }
        );


    revealItems.forEach((item) => {

        item.style.opacity = "0";

        item.style.transform =
            "translateY(25px)";

        item.style.transition =
            "opacity .7s ease, transform .7s ease";

        observer.observe(item);

    });


    /* =====================================
       SEARCH
    ===================================== */

    const searchBtn =
        document.getElementById("searchBtn");

    if (searchBtn) {

        searchBtn.addEventListener(
            "click",
            () => {

                alert(
                    "Search system will be added in the Products phase."
                );

            }
        );

    }


    /* =====================================
       CART
    ===================================== */

    const cartBtn =
        document.getElementById("cartBtn");

    if (cartBtn) {

        cartBtn.addEventListener(
            "click",
            () => {

                alert(
                    "Cart system will be added in the E-commerce phase."
                );

            }
        );

    }

});