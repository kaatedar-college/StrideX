<?php

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$username = isset($_SESSION['first_name'])
    ? htmlspecialchars($_SESSION['first_name'])
    : "Guest";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StrideX Home</title>
</head>

<body>

<?php

$username = isset($_SESSION['first_name'])
    ? htmlspecialchars($_SESSION['first_name'])
    : "Guest";

?>

<h1>Hello, <?php echo $username; ?> 👋</h1>

    <button onclick="window.location.href='php/logout.php'">
        Logout
    </button>

</body>

</html>