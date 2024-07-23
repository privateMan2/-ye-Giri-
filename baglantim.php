<?php
$host = "localhost";
$kullanici = "root";
$parola = "";
$v_tabani = "user_db";

$baglantikontrol = mysqli_connect($host, $kullanici, $parola, $v_tabani);

if (!$baglantikontrol) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}

mysqli_set_charset($baglantikontrol, "UTF8");
?>
