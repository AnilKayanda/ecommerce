<?php
// Bağlanmak istediğimiz sunucu adresi
$sunucu = "localhost";
// Sunucu Kullanıcı Adı ve Parola 
// (Kendi veri tabanı bilgilerinizle değiştirmelisiniz)
$kullaniciAd = "root";
$parola = "";
$veriTabani = "signup";
try {
    //$baglanti= new PDO("mysql:host=$sunucu;dbname=$veriTabani", $kullaniciAd, $parola);
    $conn = mysqli_connect($sunucu, $kullaniciAd, $parola, $veriTabani);
    $baglanti = new PDO("mysql:host=$sunucu;dbname=$veriTabani;charset=utf8", $kullaniciAd, $parola);
    // PDO Hata Modu belirtiliyor.
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bağlantı başarısız: " . $e->getMessage());
}
