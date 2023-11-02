<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Ad = $_POST['Ad'];
    $Soyad = $_POST['Soyad'];
    $ePosta = $_POST['Eposta'];
    $Parola = $_POST['parola'];
    $DogumTarih = $_POST['Dogum_Tarihi'];
    $Cinsiyet = @$_POST['Cinsiyet'];

    $ifade = $baglanti->prepare("CALL KullaniciEkle(:Ad,:Soyad,:Eposta,:Parola,:Dogum_Tarihi,:Cinsiyet,@Hata)");
    $ifade->bindParam(':Ad', $Ad, PDO::PARAM_STR, 45);
    $ifade->bindParam(':Soyad', $Soyad, PDO::PARAM_STR, 45);
    $ifade->bindParam(':Eposta', $ePosta, PDO::PARAM_STR, 45);
    $ifade->bindParam(':Parola', $Parola, PDO::PARAM_STR, 32);
    $ifade->bindParam(':Dogum_Tarihi', $DogumTarih, PDO::PARAM_STR, 32);
    $ifade->bindParam(':Cinsiyet', $Cinsiyet, PDO::PARAM_STR, 1);

    $eklemeDurum = $ifade->execute();
    $ifade->closeCursor(); // Önceki sorgu sonuç kümesini temizle

    $kayit = $baglanti->query("SELECT @Hata AS Hata")->fetch(PDO::FETCH_ASSOC);
    switch ($kayit['Hata']) {
        case 1:
            echo "Kullanıcı eklendi";
            // Yönlendirme yap
            header("Location: /projects/Project%202/home2.html");
            exit;
            break;
        case 2:
            echo "Lütfen tüm alanları doldurunuz";
            break;
        case 3:
            echo "Girilen e-posta daha önce kullanılmıştır";
            break;
        case 4:
            echo "Ad alanı boş olamaz";
            break;
        case 5:
            echo "Soyad boş olamaz";
            break;
        case 6:
            echo "E-posta boş olamaz";
            break;
        case 8:
            echo "E-posta boş olamaz";
            break;
        default:
            echo "Kayıt işlemi tamamlanmadı <br/>" . $kayit['Hata'];
    }
}

$baglanti = null;
