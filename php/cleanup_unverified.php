<?php

require_once "db.php";

$sql = "DELETE FROM users
        WHERE is_verified = 0
        AND created_at < DATE_SUB(NOW(), INTERVAL 24 HOUR)";

mysqli_query($conn, $sql);