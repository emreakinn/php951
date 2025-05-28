<?php require_once('header.php'); ?>
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
                            <td><?php echo $gelenMesajRow['isim'] . '' . $gelenMesajRow['isim']; ?></td>
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
<?php require_once('footer.php'); ?>