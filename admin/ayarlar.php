<?php
require_once('header.php');

if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];

    $ayarSil = $db->prepare('delete from ayarlar where id=?');
    $ayarSil->execute(array($id));

    if ($ayarSil->rowCount()) {
        echo '<script> alert("Kayıt Silindi") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
    } else {
        echo '<script> alert("Hata Alındı") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
    }
} else if (isset($_GET['updateId'])) {
    $id = $_GET['updateId'];
    $veriCek = $db->prepare('select * from ayarlar where id=?');
    $veriCek->execute(array($id));
    $veriCekRow = $veriCek->fetch();

    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
            myModal.show();
        });
    </script>
    ';
}

?>
<!-- Admin Body Section Start -->
<div class="row">
    <div class="col-md-6">
        <h3>Site Ayaları</h3>

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
                    <input type="url" name="instagram" placeholder="Instagram Adresiniz" class="form-control">
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
                <div class="col-md-3 justify-content-end" style="display:flex; align-items:end;">
                    <button type="submit" class="btn btn-success w-100" name="ayarKaydet">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6 flexList gap-2">
        <?php
        $ayarlar = $db->prepare('select * from ayarlar order by id desc limit 1');
        $ayarlar->execute();
        $ayarlarRow = $ayarlar->fetch();
        ?>
        <h3>Bilgiler</h3>
        <div class="row">
            <div class="col-12">
                <b>Açıklama:</b> <br>
                <?php echo $ayarlarRow['kisaAciklama']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <b>Telefon:</b><br>
                <?php echo $ayarlarRow['telefon']; ?>
            </div>
            <div class="col-md-6">
                <b>Whatsapp:</b><br>
                <?php echo $ayarlarRow['wp']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <b>E-Posta:</b><br>
                <?php echo $ayarlarRow['eposta']; ?>
            </div>
            <div class="col-md-6">
                <b>Adres:</b><br>
                <?php echo $ayarlarRow['adres']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php echo $ayarlarRow['harita']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <b>Facebook:</b> <br>
                <a class="text-dark" href="<?php echo $ayarlarRow['facebook']; ?>" target="_blank">@<?php echo substr($ayarlarRow['facebook'], 8); ?></a>
            </div>
            <div class="col-md-3">
                <b>İnstagram:</b> <br>
                <a class="text-dark" href="<?php echo $ayarlarRow['instagram']; ?>" target="_blank">@<?php echo substr($ayarlarRow['instagram'], 8); ?></a>
            </div>
            <div class="col-md-3">
                <b>Twitter:</b> <br>
                <a class="text-dark" href="<?php echo $ayarlarRow['twitter']; ?>" target="_blank">@<?php echo substr($ayarlarRow['twitter'], 8); ?></a>
            </div>
            <div class="col-md-3">
                <b>Linkedin:</b> <br>
                <a class="text-dark" href="<?php echo $ayarlarRow['linkedin']; ?>" target="_blank">@<?php echo substr($ayarlarRow['linkedin'], 8); ?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $ayarlarRow['logo']; ?>" class="w-100">
            </div>
            <div class="col-md-3 my-auto">
                <a class="btn btn-warning w-100" href="ayarlar.php?updateId=<?php echo $ayarlarRow['id']; ?>">Düzenle</a>
            </div>
            <div class="col-md-3 my-auto">
                <a class="btn btn-danger w-100" href="ayarlar.php?deleteId=<?php echo $ayarlarRow['id']; ?>">Sil</a>
            </div>
        </div>
    </div>
</div>
<!-- Admin Body Section End -->

<?php
if (isset($_POST['ayarKaydet'])) {
    $logo = '../assets/img/' . $_FILES['logo']['name'];

    if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo)) {
        $ayarKaydet = $db->prepare('insert into ayarlar(kisaAciklama,telefon,wp,eposta,adres,harita,facebook,instagram,twitter,linkedin,logo) values(?,?,?,?,?,?,?,?,?,?,?)');
        $ayarKaydet->execute(array($_POST['kisaAciklama'], $_POST['telefon'], $_POST['wp'], $_POST['eposta'], $_POST['adres'], $_POST['harita'], $_POST['facebook'], $_POST['instagram'], $_POST['twitter'], $_POST['linkedin'], $logo));

        if ($ayarKaydet->rowCount()) {
            echo '<script>alert("Ayarlar Kaydedildi")</script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        } else {
            echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        }
    }
}
?>

<!-- Update Modal Start -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Site Ayarlarını Güncelleme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="flexList gap-2">
                    <textarea name="kisaAciklamaUP" rows="5" class="form-control"><?php echo $veriCekRow['kisaAciklama'] ?></textarea>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="tel" name="telefonUP" value="<?php echo $veriCekRow['telefon'] ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="tel" name="wpUP" value="<?php echo $veriCekRow['wp'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="email" name="epostaUP" value="<?php echo $veriCekRow['eposta'] ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="adresUP" value="<?php echo $veriCekRow['adres'] ?>" class="form-control">
                        </div>
                    </div>
                    <textarea name="haritaUP" rows="5" class="form-control"><?php echo $veriCekRow['harita'] ?></textarea>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="url" name="facebookUP" value="<?php echo $veriCekRow['facebook'] ?>" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="url" name="instagramUP" value="<?php echo $veriCekRow['instagram'] ?>" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="url" name="twitterUP" value="<?php echo $veriCekRow['twitter'] ?>" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="url" name="linkedinUP" value="<?php echo $veriCekRow['linkedin'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <img src="<?php echo $veriCekRow['logo'] ?>" alt="" class="w-100">
                            <input type="file" name="logoUP" class="form-control">
                        </div>
                        <div class="col-md-3 justify-content-end" style="display:flex; align-items:end;">
                            <button type="submit" class="btn btn-success w-100" name="ayarGuncelle">Güncelle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update Modal End -->

<!-- Update module Start -->
<?php
if (isset($_POST['ayarGuncelle'])) {
    $logoUP = '../assets/img/' . $_FILES['logoUP']['name'];
    if (move_uploaded_file($_FILES['logoUP']['tmp_name'], $logoUP)) {
        $ayarGuncelle = $db->prepare('update ayarlar set kisaAciklama=?, telefon=?, wp=?, eposta=?, adres=?, harita=?, facebook=?, instagram=?, twitter=?, linkedin=?, logo=?, where id=?');
        $ayarGuncelle->execute(array($_POST['kisaAciklamaUP'], $_POST['telefonUP'], $_POST['wpUP'], $_POST['epostaUP'], $_POST['adresUP'], $_POST['haritaUP'], $_POST['facebookUP'], $_POST['instagramUP'], $_POST['twitterUP'], $_POST['linkedinUP'], $logoUP, $id));
        if ($ayarGuncelle->rowCount()) {
            echo '<script> alert("Kayıt Güncellendi") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        } else {
            echo '<script> alert("Hata Alındı") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        }
    } else {
        $ayarGuncelle = $db->prepare('update ayarlar set kisaAciklama=?, telefon=?, wp=?, eposta=?, adres=?, harita=?, facebook=?, instagram=?, twitter=?, linkedin=? where id=?');
        $ayarGuncelle->execute(array($_POST['kisaAciklamaUP'], $_POST['telefonUP'], $_POST['wpUP'], $_POST['epostaUP'], $_POST['adresUP'], $_POST['haritaUP'], $_POST['facebookUP'], $_POST['instagramUP'], $_POST['twitterUP'], $_POST['linkedinUP'], $id));
        if ($ayarGuncelle->rowCount()) {
            echo '<script> alert("Kayıt Güncellendi") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        } else {
            echo '<script> alert("Hata Alındı") </script><meta http-equiv="refresh" content="0; url=ayarlar.php">';
        }
    }
}
?>
<!-- Update Module End -->

<?php require_once('footer.php'); ?>