<?php require_once('header.php');

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];

    $aboutDelete = $db->prepare('delete from hakkimizda where id=?');
    $aboutDelete->execute(array($id));

    if ($aboutDelete->rowCount()) {
        echo '<script> alert("Kayıt Silindi") </script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
    } else {
        echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
    }
} else if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];

    $aboutSelect = $db->prepare('select * from hakkimizda where id=?');
    $aboutSelect->execute(array($id));
    $aboutSelectRow = $aboutSelect->fetch();

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
    <div class="col-12">
        <h3>Hakkımızda Sayfa Ayarları</h3>
    </div>
</div>
<div class="row">
    <form action="" method="post" class="row" enctype="multipart/form-data">
        <div class="col-md-9 flexList row-gap-3">
            <input type="text" name="baslik" placeholder="Başlık Girin" class="form-control">
            <textarea name="aciklama" id="editor1" placeholder="Tanıtım Yazısı Girin"></textarea>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor1'))
                    .then(editor => {
                        editor.ui.view.editable.element.style.height = '300px';
                        editor.ui.view.element.style.width = '100%';
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
        </div>
        <div class="col-md-3 flexList row-gap-3">
            <textarea name="metaDesc" placeholder="Kısa Açıklama Girin" rows="8" class="form-control"></textarea>
            <label>
                Banner Görsel Ekle
                <input type="file" name="gorsel" class="form-control">
            </label>
            <input type="text" name="alt" placeholder="Görsel Kısa Açıklama" class="form-control">
            <input type="submit" value="Kaydet" class="btn btn-success" name="kaydet">
        </div>
    </form>
</div>
<div class="row mt-5">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="w-25">Görsel</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Meta Desc</th>
                    <th>Görsel Açıklama</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $aboutlist = $db->prepare('select * from hakkimizda order by id desc');
                $aboutlist->execute();
                if ($aboutlist->rowCount()) {
                    foreach ($aboutlist as $aboutlistRow) {
                ?>
                        <tr>
                            <td><img src="<?php echo $aboutlistRow['gorsel']; ?>" class="w-100"></td>
                            <td><?php echo $aboutlistRow['baslik']; ?></td>
                            <td><?php echo substr($aboutlistRow['aciklama'], 0, 150); ?></td>
                            <td><?php echo substr($aboutlistRow['metaDesc'], 0, 100); ?></td>
                            <td><?php echo $aboutlistRow['alt']; ?></td>
                            <td><a href="hakkimizda.php?updateID=<?php echo $aboutlistRow['id']; ?>" class="btn btn-warning">Düzenle</a></td>
                            <td><a href="hakkimizda.php?deleteID=<?php echo $aboutlistRow['id']; ?>" class="btn btn-danger">Sil</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Admin Body Section End -->

<!-- About Us Insert Module Start -->
<?php
if (isset($_POST['kaydet'])) {
    $gorsel = '../assets/img/' . $_FILES['gorsel']['name'];

    if (move_uploaded_file($_FILES['gorsel']['tmp_name'], $gorsel)) {
        $saveAbout = $db->prepare('insert into hakkimizda(baslik,aciklama,metaDesc,gorsel,alt) values(?,?,?,?,?)');
        $saveAbout->execute(array($_POST['baslik'], $_POST['aciklama'], $_POST['metaDesc'], $gorsel, $_POST['alt']));

        if ($saveAbout->rowCount()) {
            echo '<script>alert("Kayıt Eklendi")</script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
        } else {
            echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
        }
    }
}
?>
<!-- About Us Insert Module End -->

<!-- About Us Update Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hakkımızda Sayfası Güncelleme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="flexList row-gap-2">
                    <input type="text" name="baslikUP" value="<?php echo $aboutSelectRow['baslik'] ?>" class="form-control">
                    <textarea name="aciklamaUP" id="editor2"><?php echo $aboutSelectRow['aciklama'] ?></textarea>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editor2'))
                            .then(editor => {
                                editor.ui.view.editable.element.style.height = '300px';
                                editor.ui.view.element.style.width = '100%';
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    <textarea name="metaDescUP" rows="4" class="form-control"><?php echo $aboutSelectRow['metaDesc'] ?></textarea>
                    <div class="row">
                        <div class="col-md-6 my-auto">
                            <img src="<?php echo $aboutSelectRow['gorsel']; ?>" class="w-100">
                        </div>
                        <div class="col-md-6 my-auto flexList row-gap-2">
                            <label>Görsel Güncelle</label>
                            <input type="file" name="gorselUP" class="form-control">
                            <label>Görsel Açıklaması</label>
                            <input type="text" name="altUP" value="<?php echo $aboutSelectRow['metaDesc'] ?>" class="form-control">
                            <input type="submit" value="Güncelle" class="btn btn-success" name="guncelle">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- About Us Update Modal End -->

<?php

if (isset($_POST['guncelle'])) {
    $gorselUP = '../assets/img/' . $_FILES['gorselUP']['name'];
    if (move_uploaded_file($_FILES['gorselUP']['tmp_name'], $gorselUP)) {
        $aboutUpdate = $db->prepare('update hakkimizda set baslik=?, aciklama=?, metaDesc=?, gorsel=?, alt=? where id=?');
        $aboutUpdate->execute(array($_POST['baslikUP'], $_POST['aciklamaUP'], $_POST['metaDescUP'], $gorselUP, $_POST['altUP'], $id));

        if ($aboutUpdate->rowCount()) {
            echo '<script> alert("Güncelleme Başarılı") </script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
        }
    } else {
        $aboutUpdate = $db->prepare('update hakkimizda set baslik=?, aciklama=?, metaDesc=?, alt=? where id=?');
        $aboutUpdate->execute(array($_POST['baslikUP'], $_POST['aciklamaUP'], $_POST['metaDescUP'], $_POST['altUP'], $id));

        if ($aboutUpdate->rowCount()) {
            echo '<script> alert("Güncelleme Başarılı") </script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=hakkimizda.php">';
        }
    }
}


?>

<?php require_once('footer.php'); ?>