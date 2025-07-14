<?php require_once('header.php');

$yaziSay = $db->prepare('select count(*) from yazilar where durum="Yayında"');
$yaziSay->execute();
$yaziSayRow = $yaziSay->fetchColumn();

$mesajSay = $db->prepare('select count(*) from mesajlar where durum="Okunmadı"');
$mesajSay->execute();
$mesajSayRow = $mesajSay->fetchColumn();


$hizmetSay = $db->prepare('select count(*) from hizmetler');
$hizmetSay->execute();
$hizmetSayRow = $hizmetSay->fetchColumn();

?>
<!-- Admin Body Section Start -->
<div class="row">
    <div class="col-12">
        <h3>Dashboard</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5>Yazılar</h5>
                <hr>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th class="text-end">Düzenle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sonYazilar = $db->prepare('select * from yazilar order by id desc limit 3');
                        $sonYazilar->execute();

                        if ($sonYazilar->rowCount()) {
                            foreach ($sonYazilar as $sonYazilarRow) {
                        ?>
                                <tr>
                                    <td> <a href="../makale.php?postID=<?php echo $sonYazilarRow['id']; ?>" class="text-dark" target="_blank"><?php echo $sonYazilarRow['baslik']; ?></a></td>
                                    <td class="text-end"><a href="yazilar.php?updateID=<?php echo $sonYazilarRow['id']; ?>" class="text-dark">Düzenle</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                Yayında: <?php echo $yaziSayRow; ?> Adet / <a href="yazilar.php" class="text-dark">Tümünü Gör</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5>Mesajlar</h5>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mesaj</th>
                            <th class="text-end">Durum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mesajlar = $db->prepare('select * from mesajlar order by id desc limit 3');
                        $mesajlar->execute();

                        if ($mesajlar->rowCount()) {
                            foreach ($mesajlar as $mesajlarRow) {
                        ?>
                                <tr>
                                    <td><a href="mesajlar.php?readID=<?php echo $mesajlarRow['id']; ?>" class="text-dark"><?php echo substr($mesajlarRow['mesaj'], 0, 34) ?>...</a></td>
                                    <td class="text-end"><a href="mesajlar.php?readID=<?php echo $mesajlarRow['id']; ?>" class="text-dark"><?php echo $mesajlarRow['durum']; ?></a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                Mesaj Adeti: <?php echo $mesajSayRow; ?> Adet / <a href="mesajlar.php" class="text-dark">Tümünü Gör</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5>Hizmetler</h5>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Hizmet Adı</th>
                            <th class="text-end">Düzenle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hizmetList = $db->prepare('select * from hizmetler order by baslik asc');
                        $hizmetList->execute();

                        if ($hizmetList->rowCount()) {
                            foreach ($hizmetList as $hizmetListRow) {
                        ?>
                                <tr>
                                    <td><?php echo $hizmetListRow['baslik'] ?></td>
                                    <td class="text-end"><a href="hizmetler.php?updateID=<?php echo $hizmetListRow['id'] ?>" class="text-dark">Düzenle</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                Hizmet Adeti: <?php echo $hizmetSayRow; ?> / <a href="hizmetler.php" class="text-dark">Tümünü Gör</a>
            </div>
        </div>
    </div>
</div>
<!-- Admin Body Section End -->
<?php require_once('footer.php'); ?>