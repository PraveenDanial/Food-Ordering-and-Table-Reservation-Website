<?php

$host = '127.0.0.1';
$port = '3308';
$db = 'food_db';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=food_db", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Show success in browser console
    echo "<script>console.log('✅ Connected successfully');</script>";
} catch (PDOException $e) {
    // Show error in browser console
    $error = $e->getMessage();
    echo "<script>console.error('❌ Connection failed: " . addslashes($error) . "');</script>";
}
?>
