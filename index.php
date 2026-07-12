<?php

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: pages/login.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StrideX Home</title>
</head>

<body>

    <h1>Hello, <?php echo $_SESSION['first_name']; ?> 👋</h1>

    <button onclick="window.location.href='php/logout.php'">
        Logout
    </button>

</body>

</html>