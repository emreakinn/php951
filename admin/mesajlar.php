<?php require_once('header.php');

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];

    $mesajSil = $db->prepare('delete from mesajlar where id=?');
    $mesajSil->execute(array($id));

    if ($mesajSil->rowCount()) {
        echo '<script> alert("Mesaj Silindi") </script><meta http-equiv="refresh" content="0; url=mesajlar.php">';
    } else {
        echo '<script> alert("Mesaj Silinemedi") </script><meta http-equiv="refresh" content="0; url=mesajlar.php">';
    }
} else if (isset($_GET['readID'])) {
    $id = $_GET['readID'];

    $mesaj = $db->prepare('select * from mesajlar where id=?');
    $mesaj->execute(array($id));
    $mesajRow = $mesaj->fetch();

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
        <h3>Gelen Mesajlar</h3>
    </div>
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>İsim</th>
                    <th>E-Posta</th>
                    <th>Konu</th>
                    <th>Mesaj</th>
                    <th>Durum</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $gelenMesaj = $db->prepare('select * from mesajlar order by id desc');
                $gelenMesaj->execute();

                if ($gelenMesaj->rowCount()) {
                    foreach ($gelenMesaj as $gelenMesajRow) {
                ?>
                        <tr>
                            <td><?php echo $gelenMesajRow['isim'] . ' ' . $gelenMesajRow['soyisim']; ?></td>
                            <td><?php echo $gelenMesajRow['eposta']; ?></td>
                            <td><?php echo $gelenMesajRow['konu']; ?></td>
                            <td><?php echo substr($gelenMesajRow['mesaj'], 0, 80); ?>...</td>
                            <td><a href="mesajlar.php?readID=<?php echo $gelenMesajRow['id']; ?>" class="btn btn-info"><?php echo $gelenMesajRow['durum']; ?></a></td>
                            <td><a href="mesajlar.php?deleteID=<?php echo $gelenMesajRow['id']; ?>" class="btn btn-danger">Sil</a></td>
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

<!-- Mesaj Module Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $mesajRow['isim'] . ' ' . $mesajRow['soyisim']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><b>Konu: </b><?php echo $mesajRow['konu'] ?></p>
                <b>Mesaj: </b>
                <p><?php echo $mesajRow['mesaj'] ?></p>
                <p><b>E Posta: </b><a href="mailto:<?php echo $mesajRow['eposta'] ?>"><?php echo $mesajRow['eposta'] ?></a></p>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <?php
                    if ($mesajRow['durum'] == 'Okunmadı') {
                    ?>
                        <button type="submit" class="btn btn-success" name="okumaDurumu">Okundu Olarak İşaretle</button>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Mesaj Module End -->

<!-- Durum Module Start -->
<?php

if (isset($_POST['okumaDurumu'])) {
    $okunmaDurum = $db->prepare('update mesajlar set durum="Okundu" where id=?');
    $okunmaDurum->execute(array($id));

    if ($okunmaDurum->rowCount()) {
        echo '<script> alert("Durum Güncellendi") </script><meta http-equiv="refresh" content="0; url=mesajlar.php">';
    } else {
        echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=mesajlar.php">';
    }
}

?>
<!-- Durum Module End -->
<?php require_once('footer.php'); ?>