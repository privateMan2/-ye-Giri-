<?php
include("baglantim.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); // SHA-256 ile hash'leme

    $bagl = new mysqli("localhost", "root", "", "user_db");

    if ($bagl->connect_error) {
        die("Bağlantı hatası: " . $bagl->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $bagl->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Kayıt başarılı, kullanıcıyı giriş sayfasına yönlendir
        header("Location: giris.html?email=$email");
        exit();
    } else {
        echo "Kayıt başarısız: " . $stmt->error;
    }

    $stmt->close();
    $bagl->close();
}
?>
