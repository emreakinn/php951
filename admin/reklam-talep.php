<?php require_once('header.php');

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];

    $deleteAds = $db->prepare('delete from reklam_talep where id=?');
    $deleteAds->execute(array($id));

    if ($deleteAds->rowCount()) {
        echo '<script> alert("Talep Silindi") </script><meta http-equiv="refresh" content="0; url=reklam-talep.php">';
    } else {
        echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=reklam-talep.php">';
    }
} elseif (isset($_GET['onay'])) {
    $id = $_GET['onay'];

    $updateDurum = $db->prepare('update reklam_talep set durum="Onaylandı" where id=?');
    $updateDurum->execute(array($id));

    if ($updateDurum->rowCount()) {
        echo '<script> alert("Talep Onaylandı") </script><meta http-equiv="refresh" content="0; url=reklam-talep.php">';
    } else {
        echo '<script> alert("Hata Oluştu") </script><meta http-equiv="refresh" content="0; url=reklam-talep.php">';
    }
}

?>
<!-- Admin Body Section Start -->
<div class="row">
    <div class="col-12">
        <h3>Reklam Talepleri</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 150px;">Görsel</th>
                    <th>İsim</th>
                    <th>Telefon</th>
                    <th>E-Posta</th>
                    <th>URL (Link)</th>
                    <th>Durum</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $ads = $db->prepare('select * from reklam_talep order by id desc');
                $ads->execute();

                if ($ads->rowCount()) {
                    foreach ($ads as $adsSatir) {
                ?>
                        <tr>
                            <td><img src=".<?php echo $adsSatir['gorsel'] ?>" class="w-100"></td>
                            <td><?php echo $adsSatir['isim'] ?></td>
                            <td><?php echo $adsSatir['telefon'] ?></td>
                            <td><?php echo $adsSatir['eposta'] ?></td>
                            <td><?php echo $adsSatir['adres'] ?></td>
                            <td>
                                <a href="reklam-talep.php?onay=<?php echo $adsSatir['id'] ?>" class="btn btn-info">
                                    <?php echo $adsSatir['durum']; ?>
                                </a>
                            </td>
                            <td><a href="reklam-talep.php?deleteID=<?php echo $adsSatir['id'] ?>" class="btn btn-warning">Sil</a></td>
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