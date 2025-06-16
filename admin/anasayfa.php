<?php require_once('header.php'); ?>
<!-- Admin Body Section Start -->
<div class="row">

    <div class="col-md-6">
        <h3>Ana Sayfa Ayarları</h3>
    </div>
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Ekle
            </button>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ana Sayfa Ayarları</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <span class="fs-3">Banner Ayarları</span>
                            <input type="text" name="baslik" placeholder="Banner Başlığı Girin" class="form-control">
                            <textarea name="aciklama" id="aciklama" placeholder="Banner Açıklama Girin"></textarea>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#aciklama'))
                                    .then(editor => {
                                        editor.ui.view.editable.element.style.height = '200px';
                                        editor.ui.view.element.style.width = '100%';
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                            <input type="url" name="video" placeholder="Youtube Video Linkini Ekleyin" class="form-control">
                            <label>Banner Görseli Ekleyin
                                <input type="file" name="gorsel" class="form-control" required>
                            </label>
                            <hr>
                            <span class="fs-3">Hizmet Paketleri</span>
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="fs-5">Paket 1</span>
                                    <input type="text" name="paketAdi1" placeholder="Paket Adı Girin" class="form-control">
                                    <input type="text" name="fiyat1" placeholder="Paket Fiyatını Gir" class="form-control">
                                    <input type="text" name="paket1ozellik1" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik2" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik3" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik4" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik5" placeholder="Özellik Girin" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-5">Paket 2</span>
                                    <input type="text" name="paketAdi2" placeholder="Paket Adı Girin" class="form-control">
                                    <input type="text" name="fiyat2" placeholder="Paket Fiyatını Gir" class="form-control">
                                    <input type="text" name="paket2ozellik1" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik2" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik3" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik4" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik5" placeholder="Özellik Girin" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-5">Paket 3</span>
                                    <input type="text" name="paketAdi3" placeholder="Paket Adı Girin" class="form-control">
                                    <input type="text" name="fiyat3" placeholder="Paket Fiyatını Gir" class="form-control">
                                    <input type="text" name="paket3ozellik1" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik2" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik3" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik4" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik5" placeholder="Özellik Girin" class="form-control">
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" value="Kaydet" name="kaydet" class="btn btn-success w-25">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Admin Body Section End -->

<!-- Save Module Start -->
<?php
if (isset($_POST['kaydet'])) {
    $banner = '../assets/img/' . $_FILES['gorsel']['name'];
    $embed = substr($_POST['video'], 32);

    if (move_uploaded_file($_FILES['gorsel']['tmp_name'], $banner)) {
        $mainpage = $db->prepare('insert into anasayfa(baslik,aciklama,video,gorsel,paketAdi1,fiyat1,paket1ozellik1,paket1ozellik2,paket1ozellik3,paket1ozellik4,paket1ozellik5,paketAdi2,fiyat2,paket2ozellik1,paket2ozellik2,paket2ozellik3,paket2ozellik4,paket2ozellik5,paketAdi3,fiyat3,paket3ozellik1,paket3ozellik2,paket3ozellik3,paket3ozellik4,paket3ozellik5) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $mainpage->execute(array($_POST['baslik'], $_POST['aciklama'], $embed, $banner, $_POST['paketAdi1'], $_POST['fiyat1'], $_POST['paket1ozellik1'], $_POST['paket1ozellik2'], $_POST['paket1ozellik3'], $_POST['paket1ozellik4'], $_POST['paket1ozellik5'], $_POST['paketAdi2'], $_POST['fiyat2'], $_POST['paket2ozellik1'], $_POST['paket2ozellik2'], $_POST['paket2ozellik3'], $_POST['paket2ozellik4'], $_POST['paket2ozellik5'], $_POST['paketAdi3'], $_POST['fiyat3'], $_POST['paket3ozellik1'], $_POST['paket3ozellik2'], $_POST['paket3ozellik3'], $_POST['paket3ozellik4'], $_POST['paket3ozellik5']));

        if ($mainpage->rowCount()) {
            echo '<script> alert("Kayıt Başarılır") </script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        }
    }
}
?>
<!-- Save Module End -->
<?php require_once('footer.php'); ?>