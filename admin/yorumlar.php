<?php require_once('header.php');
if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];

    $yorumSil = $db->prepare('delete from yorumlar where id=?');
    $yorumSil->execute(array($id));

    if ($yorumSil->rowCount()) {
        echo '<script> alert("Yorum Silindi") </script><meta http-equiv="refresh" content="0; url=yorumlar.php">';
    } else {
        echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=yorumlar.php">';
    }
} elseif (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];

    if ($id != '') {
        $durum = $db->prepare('update yorumlar set durum="Onaylandı" where id=?');
        $durum->execute(array($id));

        if ($durum->rowCount()) {
            echo '<script> alert("Yorum Onaylandı") </script><meta http-equiv="refresh" content="0; url=yorumlar.php">';
        } else {
            echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=yorumlar.php">';
        }
    }
}
?>
<!-- Admin Body Section Start -->
<div class="row">
    <div class="col-12">
        <h3>Yorumlar</h3>
    </div>
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>İsim</th>
                    <th>Blog Yazısı</th>
                    <th>Yorum</th>
                    <th>E-Posta</th>
                    <th>Durum</th>
                    <th>Onay</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $yorumlar = $db->prepare('select * from yorumlar order by id desc');
                $yorumlar->execute();

                if ($yorumlar->rowCount()) {
                    foreach ($yorumlar as $yorumlarSatir) {
                ?>
                        <tr>
                            <td><?php echo $yorumlarSatir['isim']; ?></td>
                            <td><?php echo $yorumlarSatir['baslik']; ?></td>
                            <td><?php echo $yorumlarSatir['yorum']; ?></td>
                            <td><?php echo $yorumlarSatir['eposta']; ?></td>
                            <td><?php echo $yorumlarSatir['durum']; ?></td>
                            <td><a href="yorumlar.php?updateID=<?php echo $yorumlarSatir['id']; ?>" class="btn btn-info">Onayla</a></td>
                            <td><a href="yorumlar.php?deleteID=<?php echo $yorumlarSatir['id']; ?>" class="btn btn-danger">Sil</a></td>
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
<?php require_once('footer.php'); ?>