<?php
$host = "localhost";
$config_username = "root";
$password = "";
$db = "onlinecakeshop";

try {
    // Suppress warnings with @ and rely on exception catching
    $conn = @mysqli_connect($host, $config_username, $password, $db);
    if (!$conn) {
        throw new Exception(mysqli_connect_error());
    }
} catch (Exception $e) {
    die("<div style='font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>
            <h2 style='color: red;'>Database Connection Error</h2>
            <p>Could not connect to the database. Error: <strong>" . htmlspecialchars($e->getMessage()) . "</strong></p>
            <p style='color: #555;'><strong>Solution:</strong> Please open your XAMPP Control Panel and ensure that the <strong>MySQL</strong> module is Startedy and running.</p>
         </div>");
}