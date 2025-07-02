<?php require_once('header.php');

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];

    $dijitalSil = $db->prepare('delete from dijital where id=?');
    $dijitalSil->execute(array($id));

    if ($dijitalSil->rowCount()) {
        echo '<script> alert("Kayıt Silindi") </script><meta http-equiv="refresh" content="1; url=dijital-pazarlama.php">';
    } else {
        echo '<script> alert("Kayıt Silinemedi") </script><meta http-equiv="refresh" content="1; url=dijital-pazarlama.php">';
    }
} else if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];

    $dijitalInfo = $db->prepare('select * from dijital where id=?');
    $dijitalInfo->execute(array($id));
    $dijitalInfoRow = $dijitalInfo->fetch();

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
        <h3>Dijital Pazarlama Entegrasyonlar</h3>
    </div>
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Entegrasyon
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Dijital Pazarlama Entegrasyonlar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="flexList gap-2">
                            <input type="text" name="console" placeholder="Google Search Console User ID Ekleyin" class="form-control">
                            <input type="text" name="analitik" placeholder="Google Analytics User ID Ekleyin" class="form-control">
                            <input type="text" name="pixel" placeholder="Facebook Pixel User ID Ekleyin" class="form-control">
                            <input type="submit" value="Kaydet" name="kaydet" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php
    $dijital = $db->prepare('select * from dijital order by id desc limit 1');
    $dijital->execute();
    $dijitalRow = $dijital->fetch();
    ?>
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Google Console</th>
                    <th>Google Analytics</th>
                    <th>Facebook Pixel</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $dijitalRow['console'] ?></td>
                    <td><?php echo $dijitalRow['analitik'] ?></td>
                    <td><?php echo $dijitalRow['pixel'] ?></td>
                    <td><a href="dijital-pazarlama.php?updateID=<?php echo $dijitalRow['id'] ?>" class="btn btn-warning">Düzenle</a></td>
                    <td><a href="dijital-pazarlama.php?deleteID=<?php echo $dijitalRow['id'] ?>" class="btn btn-danger">Sil</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Admin Body Section End -->

<!-- Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dijital Pazarlama Entegrasyon Güncelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="text" name="consoleUP" value="<?php echo $dijitalInfoRow['console'] ?>" class="form-control">
                    <input type="text" name="analitikUP" value="<?php echo $dijitalInfoRow['analitik'] ?>" class="form-control">
                    <input type="text" name="pixelUP" value="<?php echo $dijitalInfoRow['pixel'] ?>" class="form-control">
                    <input type="hidden" name="ID" value="<?php echo $dijitalInfoRow['id'] ?>">
                    <input type="submit" value="Güncelle" name="guncelle" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->


<!-- Add Digital Codes Start -->
<?php

if (isset($_POST['kaydet'])) {
    $digital = $db->prepare('insert into dijital(console,analitik,pixel) values(?,?,?)');
    $digital->execute(array($_POST['console'], $_POST['analitik'], $_POST['pixel']));
    if ($digital->rowCount()) {
        echo '<script> alert("İşlem Başarılı") </script><meta http-equiv="refresh" content="0; url=dijital-pazarlama.php">';
    } else {
        echo '<script> alert("Hata Alındı") </script><meta http-equiv="refresh" content="0; url=dijital-pazarlama.php">';
    }
}

if (isset($_POST['guncelle'])) {
    $consoleUP = $_POST['consoleUP'];
    $analitikUP = $_POST['analitikUP'];
    $pixelUP = $_POST['pixelUP'];
    $ID = $_POST['ID'];

    $guncelle = $db->prepare('update dijital set console=?, analitik=?, pixel=? where id=?');
    $guncelle->execute(array($consoleUP, $analitikUP, $pixelUP, $ID));

    if ($guncelle->rowCount()) {
        echo '<script>alert("Güncelleme Başarılı")</script><meta http-equiv="refresh" content="0; url=dijital-pazarlama.php">';
    } else {
        echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=dijital-pazarlama.php">';
    }
}

?>
<!-- Add Digital Codes End -->
<?php require_once('footer.php'); ?>