<!-- require ve require_one olarak iki şekilde php sayfalarını çağırabiliriz. require_once ile bir sayfaya bir tane çağırılabilir. require ile birden fazla çağırılabilir. -->
<?php
require_once('header.php');

if (isset($_GET['bannerDeleteID'])) {
    $id = $_GET['bannerDeleteID'];

    $bannerSetDel = $db->prepare('delete from anasayfa where id=?');
    $bannerSetDel->execute(array($id));

    if ($bannerSetDel->rowCount()) {
        echo '<script>alert("Banner Silindi.")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
    } else {
        echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
    }
} elseif (isset($_GET['bannerUpdateID'])) {
    $id = $_GET['bannerUpdateID'];

    $bannerSetUp = $db->prepare('select * from anasayfa where id=?');
    $bannerSetUp->execute(array($id));
    $bannerSetUpFetch = $bannerSetUp->fetch();
    echo '<script>
            document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
            myModal.show();
            });
        </script>';
}



?>
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
                            <div class="fs-3">Banner Ayarları</div>
                            <input type="text" name="baslik" placeholder="Banner Başlığı Giirn" class="form-control">
                            <textarea name="aciklama" id="aciklama" placeholder="Teknik Özellikler"></textarea>
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
                                <input type="file" name="gorsel" class="form-control" required></label>
                            <hr>
                            <span class="fs-3">Hizmet Paketleri</span>
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="fs-5">Paket 1</span>
                                    <input type="text" name="paketAdi1" placeholder="Paket Adını Girin" class="form-control">
                                    <input type="text" name="fiyat1" placeholder="Paket Fiyatını Girin" class="form-control">
                                    <input type="text" name="paket1ozellik1" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik2" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik3" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik4" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket1ozellik5" placeholder="Özellik Girin" class="form-control">
                                </div>
                                <div class="col-md-4"> <span class="fs-5">Paket 2</span>
                                    <input type="text" name="paketAdi2" placeholder="Paket Adını Girin" class="form-control">
                                    <input type="text" name="fiyat2" placeholder="Paket Fiyatını Girin" class="form-control">
                                    <input type="text" name="paket2ozellik1" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik2" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik3" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik4" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket2ozellik5" placeholder="Özellik Girin" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-5">Paket 3</span>
                                    <input type="text" name="paketAdi3" placeholder="Paket Adını Girin" class="form-control">
                                    <input type="text" name="fiyat3" placeholder="Paket Fiyatını Girin" class="form-control">
                                    <input type="text" name="paket3ozellik1" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik2" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik3" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik4" placeholder="Özellik Girin" class="form-control">
                                    <input type="text" name="paket3ozellik5" placeholder="Özellik Girin" class="form-control">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <input type="submit" name="kaydet" value="Kaydet" class="btn btn-success w-25">
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
            echo '<script>alert("Ayarlar Kayıt Edildi")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        } else {
            echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        }
    }
}
?>
<!-- Save Module End -->

<!-- Setting List Start -->
<div class="row">
    <div class="col-12">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th style="width: 150px;">Görsel</th>
                    <th style="width: 150px;">Video</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Paket 1 Başlık</th>
                    <th>Paket 1 Fiyat</th>
                    <th>Paket 2 Başlık</th>
                    <th>Paket 2 Fiyat</th>
                    <th>Paket 3 Başlık</th>
                    <th>Paket 3 Fiyat</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $bannerSet = $db->prepare('select * from anasayfa order by id desc');
                $bannerSet->execute();
                if ($bannerSet->rowCount()) {
                    foreach ($bannerSet as $bannerSetRow) {
                ?>
                        <tr>
                            <td><img src="<?php echo $bannerSetRow['gorsel']; ?>" alt="" class="w-100"></td>
                            <td><iframe class="rounded" width="100%" height="50%" src="https://www.youtube.com/embed/<?php echo $bannerSetRow['video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></td>
                            <td><?php echo $bannerSetRow['baslik']; ?></td>
                            <td><?php echo $bannerSetRow['aciklama']; ?></td>
                            <td><?php echo $bannerSetRow['paketAdi1']; ?></td>
                            <td><?php echo $bannerSetRow['fiyat1']; ?> </td>
                            <td><?php echo $bannerSetRow['paketAdi2']; ?></td>
                            <td><?php echo $bannerSetRow['fiyat2']; ?> </td>
                            <td><?php echo $bannerSetRow['paketAdi3']; ?></td>
                            <td><?php echo $bannerSetRow['fiyat3']; ?> </td>
                            <td><a href="anasayfa.php?bannerUpdateID=<?php echo $bannerSetRow['id']; ?>"><button class="btn btn-warning">Düzenle</button></a></td>
                            <td><a href="anasayfa.php?bannerDeleteID=<?php echo $bannerSetRow['id']; ?>"><button class="btn btn-danger">Sil</button></a></td>
                        </tr>
                <?php
                    }
                }

                ?>

            </tbody>
        </table>
    </div>
</div>
<!-- Setting List End -->

<!-- Settings Update Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ana Sayfa Ayarlarını Güncelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelector('#close').addEventListener('click', function() {
                            window.location.href = "anasayfa.php";
                        });
                    });
                </script>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="fs-3">Banner Ayarlarını Güncelle</div>
                    <input type="text" name="baslikUP" value="<?php echo $bannerSetUpFetch['baslik']; ?>" class="form-control my-2">
                    <textarea name="aciklamaUP" id="aciklamaUP" placeholder="Teknik Özellikler"><?php echo $bannerSetUpFetch['aciklama']; ?></textarea>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#aciklamaUP'))
                            .then(editor => {
                                editor.ui.view.editable.element.style.height = '200px';
                                editor.ui.view.element.style.width = '100%';
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    <input type="url" name="videoUP" value="https://www.youtube.com/watch?v=<?php echo $bannerSetUpFetch['video']; ?>" class="form-control my-2">
                    <label><b>Mevcut Görsel</b> : <?php echo substr($bannerSetUpFetch['gorsel'], 14); ?>
                        <input type="file" name="gorselUP" class="form-control"></label>
                    <hr>
                    <span class="fs-3">Hizmet Paketlerini Güncelle</span>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="fs-5">Paket 1</span>
                            <input type="text" name="paketAdi1UP" value="<?php echo $bannerSetUpFetch['paketAdi1']; ?>" class="form-control">
                            <input type="text" name="fiyat1UP" value="<?php echo $bannerSetUpFetch['fiyat1']; ?>" class="form-control my-2">
                            <input type="text" name="paket1ozellik1UP" value="<?php echo $bannerSetUpFetch['paket1ozellik1'] ?>" class="form-control">
                            <input type="text" name="paket1ozellik2UP" value="<?php echo $bannerSetUpFetch['paket1ozellik2'] ?>" class="form-control my-2">
                            <input type="text" name="paket1ozellik3UP" value="<?php echo $bannerSetUpFetch['paket1ozellik3'] ?>" class="form-control">
                            <input type="text" name="paket1ozellik4UP" value="<?php echo $bannerSetUpFetch['paket1ozellik4'] ?>" class="form-control my-2">
                            <input type="text" name="paket1ozellik5UP" value="<?php echo $bannerSetUpFetch['paket1ozellik5'] ?>" class="form-control">
                        </div>
                        <div class="col-md-4"> <span class="fs-5">Paket 2</span>
                            <input type="text" name="paketAdi2UP" value="<?php echo $bannerSetUpFetch['paketAdi2']; ?>" class="form-control">
                            <input type="text" name="fiyat2UP" value="<?php echo $bannerSetUpFetch['fiyat2']; ?>" class="form-control my-2">
                            <input type="text" name="paket2ozellik1UP" value="<?php echo $bannerSetUpFetch['paket2ozellik1'] ?>" class="form-control">
                            <input type="text" name="paket2ozellik2UP" value="<?php echo $bannerSetUpFetch['paket2ozellik2'] ?>" class="form-control my-2">
                            <input type="text" name="paket2ozellik3UP" value="<?php echo $bannerSetUpFetch['paket2ozellik3'] ?>" class="form-control">
                            <input type="text" name="paket2ozellik4UP" value="<?php echo $bannerSetUpFetch['paket2ozellik4'] ?>" class="form-control my-2">
                            <input type="text" name="paket2ozellik5UP" value="<?php echo $bannerSetUpFetch['paket2ozellik5'] ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <span class="fs-5">Paket 3</span>
                            <input type="text" name="paketAdi3UP" value="<?php echo $bannerSetUpFetch['paketAdi3']; ?>" class="form-control">
                            <input type="text" name="fiyat3UP" value="<?php echo $bannerSetUpFetch['fiyat3']; ?>" class="form-control my-2">
                            <input type="text" name="paket3ozellik1UP" value="<?php echo $bannerSetUpFetch['paket3ozellik1'] ?>" class="form-control">
                            <input type="text" name="paket3ozellik2UP" value="<?php echo $bannerSetUpFetch['paket3ozellik2'] ?>" class="form-control my-2">
                            <input type="text" name="paket3ozellik3UP" value="<?php echo $bannerSetUpFetch['paket3ozellik3'] ?>" class="form-control">
                            <input type="text" name="paket3ozellik4UP" value="<?php echo $bannerSetUpFetch['paket3ozellik4'] ?>" class="form-control my-2">
                            <input type="text" name="paket3ozellik5UP" value="<?php echo $bannerSetUpFetch['paket3ozellik5'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input type="submit" name="guncelle" value="Güncelle" class="btn btn-success w-25">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Settings Update Modal End -->

<!-- Settings Update Module Start -->
<?php
if (isset($_POST['guncelle'])) {
    $gorselUP = '../assets/img/' . $_FILES['gorselUP']['name'];
    $embedUP = substr($_POST['videoUP'], 32, 11);
    if (move_uploaded_file($_FILES['gorselUP']['tmp_name'], $gorselUP)) {
        $bannerSetUp = $db->prepare('update anasayfa set baslik=?, aciklama=?, video=?, gorsel=?, paketAdi1=?, fiyat1=?, paket1ozellik1=?, paket1ozellik2=?, paket1ozellik3=?, paket1ozellik4=?, paket1ozellik5=?, paketAdi2=?, fiyat2=?, paket2ozellik1=?, paket2ozellik2=?, paket2ozellik3=?, paket2ozellik4=?, paket2ozellik5=?, paketAdi3=?, fiyat3=?, paket3ozellik1=?, paket3ozellik2=?, paket3ozellik3=?, paket3ozellik4=?, paket3ozellik5=? where id=?');
        $bannerSetUp->execute(array($_POST['baslikUP'], $_POST['aciklamaUP'], $embedUP, $gorselUP, $_POST['paketAdi1UP'], $_POST['fiyat1UP'], $_POST['paket1ozellik1UP'], $_POST['paket1ozellik2UP'], $_POST['paket1ozellik3UP'], $_POST['paket1ozellik4UP'], $_POST['paket1ozellik5UP'], $_POST['paketAdi2UP'], $_POST['fiyat2UP'], $_POST['paket2ozellik1UP'], $_POST['paket2ozellik2UP'], $_POST['paket2ozellik3UP'], $_POST['paket2ozellik4UP'], $_POST['paket2ozellik5UP'], $_POST['paketAdi3UP'], $_POST['fiyat3UP'], $_POST['paket3ozellik1UP'], $_POST['paket3ozellik2UP'], $_POST['paket3ozellik3UP'], $_POST['paket3ozellik4UP'], $_POST['paket3ozellik5UP'], $id));

        if ($bannerSetUp->rowCount()) {
            echo '<script>alert("Günceleme Başarılı")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        } else {
            echo '<script>alert("Hata Oluştu.")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        }
    } else {
        $embedUP = substr($_POST['videoUP'], 32, 11);
        $bannerSetUp = $db->prepare('update anasayfa set baslik=?, aciklama=?, video=?, paketAdi1=?, fiyat1=?, paket1ozellik1=?, paket1ozellik2=?, paket1ozellik3=?, paket1ozellik4=?, paket1ozellik5=?, paketAdi2=?, fiyat2=?, paket2ozellik1=?, paket2ozellik2=?, paket2ozellik3=?, paket2ozellik4=?, paket2ozellik5=?, paketAdi3=?, fiyat3=?, paket3ozellik1=?, paket3ozellik2=?, paket3ozellik3=?, paket3ozellik4=?, paket3ozellik5=? where id=?');
        $bannerSetUp->execute(array($_POST['baslikUP'], $_POST['aciklamaUP'], $embedUP, $_POST['paketAdi1UP'], $_POST['fiyat1UP'], $_POST['paket1ozellik1UP'], $_POST['paket1ozellik2UP'], $_POST['paket1ozellik3UP'], $_POST['paket1ozellik4UP'], $_POST['paket1ozellik5UP'], $_POST['paketAdi2UP'], $_POST['fiyat2UP'], $_POST['paket2ozellik1UP'], $_POST['paket2ozellik2UP'], $_POST['paket2ozellik3UP'], $_POST['paket2ozellik4UP'], $_POST['paket2ozellik5UP'], $_POST['paketAdi3UP'], $_POST['fiyat3UP'], $_POST['paket3ozellik1UP'], $_POST['paket3ozellik2UP'], $_POST['paket3ozellik3UP'], $_POST['paket3ozellik4UP'], $_POST['paket3ozellik5UP'], $id));
        if ($bannerSetUp->rowCount()) {
            echo '<script>alert("Günceleme Başarılı")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        } else {
            echo '<script>alert("Hata Oluştu.")</script><meta http-equiv="refresh" content="0; url=anasayfa.php">';
        }
    }
}
?>

<!-- Settings Update Module SEnd -->
<?php require_once('footer.php'); ?>