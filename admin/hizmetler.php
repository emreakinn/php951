<?php require_once('header.php');

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];

    $hizmetSil = $db->prepare('delete from hizmetler where id=?');
    $hizmetSil->execute(array($id));

    if ($hizmetSil->rowCount()) {
        echo '<script> alert("Hizmet Silindi") </script><meta http-equiv="refresh" content="1; url=hizmetler.php">';
    } else {
        echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="1; url=hizmetler.php">';
    }
} else if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];

    $hizmetSec = $db->prepare('select * from hizmetler where id=?');
    $hizmetSec->execute(array($id));
    $hizmetSecSatir =  $hizmetSec->fetch();

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
        <h3>Hizmetler</h3>
    </div>
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Hizmet Ekle
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Yeni Hizmet Ekle</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" name="baslik" placeholder="Hizmet Adı" class="form-control mb-3">
                            <textarea name="aciklama" id="aciklama" placeholder="Hizmet Açıklaması"></textarea>
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
                            <label class="mt-3">Banner Ekle</label>
                            <input type="file" name="gorsel" class="form-control mb-3" require>
                            <input type="submit" value="Kaydet" name="kaydet" class="btn btn-success w-100">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:150px;">Görsel</th>
                    <th>Hizmet Adı</th>
                    <th>Açıklama</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $hizmetList = $db->prepare('select * from hizmetler order by baslik asc');
                $hizmetList->execute();

                if ($hizmetList->rowCount()) {
                    foreach ($hizmetList as $hizmetListSatir) {
                ?>
                        <tr>
                            <td><img class="w-100" src="<?php echo $hizmetListSatir['gorsel']; ?>"></td>
                            <td><?php echo $hizmetListSatir['baslik']; ?></td>
                            <td><?php echo substr($hizmetListSatir['aciklama'], 0, 150); ?></td>
                            <td><a href="hizmetler.php?updateID=<?php echo $hizmetListSatir['id']; ?>" class="btn btn-warning">Düzenle</a></td>
                            <td><a href="hizmetler.php?deleteID=<?php echo $hizmetListSatir['id']; ?>" class="btn btn-danger">Sil</a></td>
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

<!--- Services Add Module Start --->

<?php

if (isset($_POST['kaydet'])) {

    $gorsel = '../assets/img/' . $_FILES['gorsel']['name'];
    if (move_uploaded_file($_FILES['gorsel']['tmp_name'], $gorsel)) {
        $hizmetEkle = $db->prepare('insert into hizmetler(baslik, aciklama, gorsel) values(?,?,?)');
        $hizmetEkle->execute(array($_POST['baslik'], $_POST['aciklama'], $gorsel));

        if ($hizmetEkle->rowCount()) {
            echo '<script> alert("Hizmet Eklendi") </script><meta http-equiv="refresh" content="0; url=hizmetler.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=hizmetler.php">';
        }
    }
}

?>

<!-- Update Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $hizmetSecSatir['baslik']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="baslikUP" value="<?php echo $hizmetSecSatir['baslik']; ?>" class="form-control mb-3">
                    <textarea name="aciklamaUP" id="aciklamaUP"><?php echo $hizmetSecSatir['aciklama']; ?></textarea>
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
                    <img src="<?php echo $hizmetSecSatir['gorsel']; ?>" class="w-50 my-3">
                    <input type="file" name="gorselUP" class="form-control mb-3">
                    <input type="submit" value="Güncelle" class="btn btn-success w-100" name="guncelle">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update Modal End -->

<!-- Update Modul Start -->

<?php

if (isset($_POST['guncelle'])) {
    $gorselUP = '../assets/img/' . $_FILES['gorselUP']['name'];
    if (move_uploaded_file($_FILES['gorselUP']['tmp_name'], $gorselUP)) {
        $guncelle = $db->prepare('update hizmetler set baslik=?, aciklama=?, gorsel=? where id=?');
        $guncelle->execute(array($_POST['baslikUP'], $_POST['aciklamaUP'], $gorselUP, $id));

        if ($guncelle->rowCount()) {
            echo '<script> alert("Güncelleme Başarılı") </script><meta http-equiv="refresh" content="0; url=hizmetler.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=hizmetler.php">';
        }
    } else {
        $guncelle = $db->prepare('update hizmetler set baslik=?, aciklama=? where id=?');
        $guncelle->execute(array($_POST['baslikUP'], $_POST['aciklamaUP'], $id));

        if ($guncelle->rowCount()) {
            echo '<script> alert("Güncelleme Başarılı") </script><meta http-equiv="refresh" content="0; url=hizmetler.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=hizmetler.php">';
        }
    }
}

?>

<!-- Update Modul End -->

<!--- Services Add Module End --->
<?php require_once('footer.php'); ?>