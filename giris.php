<?php
include("baglantim.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); // SHA-256 ile hash'leme

    $bagl = new mysqli("localhost", "root", "", "user_db");

    if ($bagl->connect_error) {
        die("Bağlantı hatası: " . $bagl->connect_error);
    }

    $sql = "SELECT id, username, password FROM users WHERE email = ?";
    $stmt = $bagl->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if ($password === $hashed_password) {
            // Giriş başarılı, hoş geldiniz mesajı ve kullanıcı adı
            echo "Giriş başarılı! Hoşgeldiniz, $username!";
        } else {
            echo "Mail adresi veya şifre hatalı.";
        }
    } else {
        echo "Mail adresi veya şifre hatalı.";
    }

    $stmt->close();
    $bagl->close();
}
?>
