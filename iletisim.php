<?php require_once('header.php') ?>

<!-- 
$ayarlarRow header.php de oluşturuldu
-->

<!-- İletişim Banner Section Start -->
<section id="iletisim" class="banner">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-1">Bize Ulaşın</h1>
                <small><a href="index.php" class="text-dark">Ana Sayfa</a> / İletişim </small>
            </div>
        </div>
    </div>
</section>
<!-- İletişim Banner Section End -->

<!-- Contact Section Start -->
<section id="info" class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 flexList">
                <i class="bi bi-telephone fs-1"></i>
                <a class="text-dark" href="tel:+9<?php echo $ayarlarRow['telefon'] ?>"><?php echo $ayarlarRow['telefon'] ?></a>
            </div>
            <div class="col-md-4 flexList">
                <i class="bi bi-whatsapp fs-1"></i>
                <a class="text-dark" href="https://wa.me/+9<?php echo $ayarlarRow['wp'] ?>">Canlı Destek</a>
            </div>
            <div class="col-md-4 flexList">
                <i class="bi bi-envelope fs-1"></i>
                <a class="text-dark" href="<?php echo $ayarlarRow['eposta'] ?>"><?php echo $ayarlarRow['eposta'] ?></a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <form action="" method="post" class="row gy-2">
                    <div class="col-md-6">
                        <input type="text" name="isim" placeholder="Adınız" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="soyisim" placeholder="Soyadınız" class="form-control">
                    </div>
                    <div class="col-12">
                        <input type="email" name="eposta" placeholder="E-Posta Adresiniz" class="form-control">
                    </div>
                    <div class="col-12">
                        <input type="text" name="konu" placeholder="Konu" class="form-control">
                    </div>
                    <div class="col-12">
                        <textarea name="mesaj" placeholder="Mesajınız" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="gonder" value="Gönder" class="btn btn-purple w-25">
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <?php echo $ayarlarRow['harita'] ?>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
<?php

if (isset($_POST['gonder'])) {
    $mesajKaydet = $db->prepare('insert into mesajlar(isim, soyisim, eposta, konu, mesaj, durum) values(?,?,?,?,?,?)');
    $mesajKaydet->execute(array($_POST['isim'], $_POST['soyisim'], $_POST['eposta'], $_POST['konu'], $_POST['mesaj'], 'Okunmadı'));

    if ($mesajKaydet->rowCount()) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function () {
        let toastEl = document.getElementById("liveToast");
        let toast = new bootstrap.Toast(toastEl, {
        delay: 2000 // 2 saniye görünür
    });

        toast.show();

        toastEl.addEventListener("hidden.bs.toast", function () {
        window.location.href = "iletisim.php";
    });
  });
</script>';
    }
}

?>

<!-- Toast Module Start -->

<div class="position-fixed" style="z-index: 1100; right:40%; top:50px;">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="./assets/img/ikon-logo.png" class="rounded me-2" alt="...">
            <strong class="me-auto">Site Uyarısı</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Mesajınız İletildi
        </div>
    </div>
</div>
<!-- Toast Module End -->
<?php require_once('footer.php') ?>