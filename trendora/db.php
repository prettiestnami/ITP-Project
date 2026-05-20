<?php
$conn = new mysqli("localhost", "root", "", "trendora_db");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>