<?php require_once('header.php'); ?>
<!-- Admin Body Section Start -->
<div class="row">
    <div class="col-md-6">
        <h3>Site Ayarları</h3>
    </div>
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Site Ayarları Ekle
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Site Ayarları</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="flexList gap-2">
                            <textarea name="kisaAciklama" placeholder="Kısa Açıklama Girin" rows="5" class="form-control"></textarea>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="tel" name="telefon" placeholder="Telefon Numaranızı Girin" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" name="wp" placeholder="Whatsapp Numaranızı Girin" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="email" name="eposta" placeholder="E-Posta Adresinizi Girin" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="adres" placeholder="Adresinizi Girin" class="form-control">
                                </div>
                            </div>
                            <textarea name="harita" placeholder="Google Maps Haritasını Ekleyin" rows="5" class="form-control"></textarea>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="url" name="facebook" placeholder="Facebook Adresiniz" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="url" name="instagram" placeholder="İnstagram Adresiniz" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="url" name="twitter" placeholder="Twitter Adresiniz" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="url" name="linkedin" placeholder="Linkedin Adresiniz" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <label>Site Logosu</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                                <div class="col-md-3 justify-contend-end" style="display:flex; align-items:end;">
                                    <button type="submit" class="btn btn-success w-100" name="kaydet">Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Admin Body Section End -->

<?php

if (isset($_POST['kaydet'])) {
    $logo = '../assets/img/' . $_FILES['logo']['name'];

    if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo)) {
        $ayarKaydet = $db->prepare('insert into ayarlar (kisaAciklama,telefon,wp,eposta,adres,harita,facebook,instagram,twitter,linkedin,logo) values (?,?,?,?,?,?,?,?,?,?,?)');
        $ayarKaydet->execute(array($_POST['kisaAciklama'], $_POST['telefon'], $_POST['wp'], $_POST['eposta'], $_POST['adres'], $_POST['harita'], $_POST['facebook'], $_POST['instagram'], $_POST['twitter'], $_POST['linkedin'], $logo));

        if ($ayarKaydet->rowCount()) {
            echo '<script> alert("Ayarlar Kaydedildi") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        }
    }
}

?>

<?php require_once('footer.php'); ?>