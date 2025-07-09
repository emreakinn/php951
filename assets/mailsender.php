<?php

require_once('baglan.php');
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';
require_once __DIR__ . '/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

try {
    // Sunucu ayarları
    $mail->isSMTP();                                      // SMTP kullan
    $mail->Host       = 'smtp.gmail.com';                 // SMTP sunucusu
    $mail->SMTPAuth   = true;                             // SMTP kimlik doğrulaması
    $mail->Username   = 'emreakinn60@gmail.com';  // Gönderici mail adresi
    $mail->Password   = 'limn eawu wahd duds';            // Şifre (Gmail için uygulama şifresi gerekebilir)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Şifreleme türü
    $mail->Port       = 587;                              // SMTP portu

    // Alıcılar
    $mail->setFrom('emreakinn60@gmail.com', 'Emre');
    $mail->addAddress('emreakinn60@gmail.com', 'Emre 2');

    // İçerik
    $mail->isHTML(true);                                  // HTML içerik

    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('tr', './phpmailer/language/'); // Opsiyonel, Türkçe hata mesajları için


    $mail->Subject = $_POST['konu'];
    $mail->Body    = $_POST['mesaj'];
    $mail->AltBody = 'Bu bir test mailidir (HTML olmayan versiyon).';

    $mail->send();

    $mesajKaydet = $db->prepare('insert into mesajlar(isim,soyisim,eposta,konu,mesaj,durum) values(?,?,?,?,?,?)');
    $mesajKaydet->execute(array($_POST['isim'], $_POST['soyisim'], $_POST['eposta'], $_POST['konu'], $_POST['mesaj'], "Okunmadı"));

    if ($mesajKaydet->rowCount()) {
        echo '<script>alert("Mesajınız başarıyla gönderildi.")</script><meta http-equiv="refresh" content="0; url=../iletisim.php">';
    }
} catch (Exception $e) {
    echo "E-posta gönderilemedi. Hata: {$mail->ErrorInfo}";
}
