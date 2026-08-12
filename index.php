<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$username = isset($_SESSION['first_name'])
    ? htmlspecialchars($_SESSION['first_name'], ENT_QUOTES, 'UTF-8')
    : "Guest";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>StrideX | Step Into Your Style</title>

    <link
        rel="stylesheet"
        href="assets/css/home.css"
    >
    <link
    rel="stylesheet"
    href="assets/css/preloader.css"
>
</head>

<body>

<?php include 'components/preloader.php'; ?>

<!-- ===============================
     NAVBAR
================================ -->

<header class="navbar">

    <div class="nav-container">

        <a href="index.php" class="brand">
            <img
                src="assets/images/logo/logo.png"
                alt="StrideX"
                class="site-logo"
            >
        </a>

        <nav class="nav-links">

            <a href="#home" class="active">
                Home
            </a>

            <a href="#featured">
                Featured
            </a>

            <a href="#categories">
                Categories
            </a>

            <a href="#new-arrivals">
                New Arrivals
            </a>

        </nav>

        <div class="nav-actions">

            <button
                type="button"
                class="nav-icon"
                id="searchBtn"
                aria-label="Search"
            >
                <span>⌕</span>
            </button>

            <button
                type="button"
                class="nav-icon"
                id="cartBtn"
                aria-label="Cart"
            >
                <span>🛒</span>
            </button>

            <div class="user-area">

                <span class="welcome-user">
                    Hi, <?php echo $username; ?>
                </span>

                <button
                    type="button"
                    class="logout-btn"
                    onclick="window.location.href='php/logout.php'"
                >
                    Logout
                </button>

            </div>

        </div>

    </div>

</header>


<!-- ===============================
     HERO
================================ -->

<main>

<section class="hero" id="home">

    <div class="hero-shape shape-one"></div>
    <div class="hero-shape shape-two"></div>

    <div class="hero-container">

        <div class="hero-content">

            <p class="eyebrow">
                STRIDEX / NEW SEASON
            </p>

            <h1>
                MOVE
                <span>YOUR WAY.</span>
            </h1>

            <p class="hero-description">
                Discover premium footwear made for
                everyday movement, confidence and
                your individual style.
            </p>

            <div class="hero-buttons">

                <a
                    href="#featured"
                    class="hero-btn primary"
                >
                    Shop Collection
                </a>

                <a
                    href="#categories"
                    class="hero-btn secondary"
                >
                    Explore
                </a>

            </div>

            <div class="hero-meta">

                <span>01</span>

                <div></div>

                <span>
                    FIND YOUR STRIDE
                </span>

            </div>

        </div>


        <!-- HERO PRODUCT -->

        <div class="hero-visual">

            <div class="blue-orbit orbit-one"></div>
            <div class="blue-orbit orbit-two"></div>

            <div class="hero-number">
                01
            </div>

            <div class="shoe-stage">

                <div class="shoe-shadow"></div>

                <div class="shoe">

                    <div class="shoe-upper">

                        <span>
                            STRIDEX
                        </span>

                    </div>

                    <div class="shoe-sole"></div>

                </div>

            </div>

            <div class="product-label">

                <span>
                    STRIDEX
                </span>

                <strong>
                    STRIDE 01
                </strong>

            </div>

        </div>

    </div>

    <div class="scroll-indicator">
        <span></span>
        Scroll to explore
    </div>

</section>


<!-- ===============================
     FEATURED
================================ -->

<section
    class="featured"
    id="featured"
>

    <div class="section-top">

        <div>

            <p class="section-label">
                01 / FEATURED
            </p>

            <h2>
                BUILT TO
                <span>MOVE.</span>
            </h2>

        </div>

        <p class="section-description">
            Explore selected StrideX styles
            designed for every kind of movement.
        </p>

    </div>


    <div class="feature-grid">

        <article class="feature-card card-large">

            <span class="card-number">
                01
            </span>

            <div class="card-shoe">
                STRIDE
            </div>

            <div class="card-info">

                <span>
                    PERFORMANCE
                </span>

                <h3>
                    Stride Runner
                </h3>

                <a href="#">
                    Explore →
                </a>

            </div>

        </article>


        <article class="feature-card card-blue">

            <span class="card-number">
                02
            </span>

            <div class="card-shoe blue-shoe">
                X
            </div>

            <div class="card-info">

                <span>
                    STREET
                </span>

                <h3>
                    Stride X
                </h3>

                <a href="#">
                    Explore →
                </a>

            </div>

        </article>


        <article class="feature-card card-light">

            <span class="card-number">
                03
            </span>

            <div class="card-shoe light-shoe">
                03
            </div>

            <div class="card-info">

                <span>
                    EVERYDAY
                </span>

                <h3>
                    Stride Classic
                </h3>

                <a href="#">
                    Explore →
                </a>

            </div>

        </article>

    </div>

</section>


<!-- ===============================
     CATEGORIES
================================ -->

<section
    class="categories"
    id="categories"
>

    <div class="category-heading">

        <p class="section-label">
            02 / CATEGORIES
        </p>

        <h2>
            FIND YOUR
            <span>STRIDE.</span>
        </h2>

        <p>
            Whatever your pace, there is a
            StrideX made for it.
        </p>

    </div>


    <div class="category-list">

        <a href="#" class="category-item">

            <span>01</span>

            <strong>
                Running
            </strong>

            <span class="arrow">
                ↗
            </span>

        </a>


        <a href="#" class="category-item">

            <span>02</span>

            <strong>
                Lifestyle
            </strong>

            <span class="arrow">
                ↗
            </span>

        </a>


        <a href="#" class="category-item">

            <span>03</span>

            <strong>
                Basketball
            </strong>

            <span class="arrow">
                ↗
            </span>

        </a>


        <a href="#" class="category-item">

            <span>04</span>

            <strong>
                Training
            </strong>

            <span class="arrow">
                ↗
            </span>

        </a>

    </div>

</section>


<!-- ===============================
     NEW ARRIVALS
================================ -->

<section
    class="new-arrivals"
    id="new-arrivals"
>

    <div class="arrival-content">

        <p class="section-label">
            03 / NEW ARRIVALS
        </p>

        <h2>
            THE NEXT
            <span>STRIDE.</span>
        </h2>

        <p>
            Fresh silhouettes.
            New energy.
            Your next favorite pair.
        </p>

        <a
            href="#featured"
            class="outline-btn"
        >
            Explore New Arrivals
        </a>

    </div>

</section>


<!-- ===============================
     FOOTER
================================ -->

<footer class="footer">

    <img
        src="assets/images/logo/logo.png"
        alt="StrideX"
        class="footer-logo"
    >

    <div class="footer-line"></div>

    <p>
        © <?php echo date("Y"); ?>
        StrideX. All rights reserved.
    </p>

</footer>

</main>

<script src="assets/js/preloader.js"></script>

<script src="assets/js/home.js"></script>

</body>
</html>