<?php require_once('header.php');

$about = $db->prepare('select * from hakkimizda order by id desc limit 1');
$about->execute();
$aboutRow = $about->fetch();

?>

<!-- About Us Banner Section Start -->
<section id="aboutUs" class="banner text-white" style="background: url(<?php echo substr($aboutRow['gorsel'], 1); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-1"><?php echo $aboutRow['baslik'] ?></h1>
                <small><a href="index.php" class="text-white">Ana Sayfa</a> / <?php echo $aboutRow['baslik'] ?> </small>
            </div>
        </div>
    </div>
</section>
<!-- About Us Banner Section Start -->

<!-- About Us Content Section Start -->
<section id="aboutUs" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php echo $aboutRow['aciklama'] ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Hizmetlerimiz</h1>
            </div>
            <?php
            $hizmetler = $db->prepare('select * from hizmetler order by baslik asc');
            $hizmetler->execute();
            if ($hizmetler->rowCount()) {
                foreach ($hizmetler as $hizmerlerRow) {
            ?>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <img src="<?php echo substr($hizmerlerRow['gorsel'], 1); ?>" alt="<?php echo $hizmerlerRow['baslik'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h2 class="text-center"><?php echo $hizmerlerRow['baslik'] ?></h2>
                                <div style="text-align: justify;">
                                    <?php echo substr($hizmerlerRow['aciklama'], 0, 300); ?>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $hizmerlerRow['id'] ?>">
                                    Daha Fazla Bilgi
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modal<?php echo $hizmerlerRow['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal<?php echo $hizmerlerRow['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modal<?php echo $hizmerlerRow['id'] ?>"><?php echo $hizmerlerRow['baslik'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo substr($hizmerlerRow['gorsel'], 1); ?>" alt="<?php echo $hizmerlerRow['baslik'] ?>" class="w-100">
                                    <?php echo $hizmerlerRow['aciklama'] ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="iletisim.php"><button type="button" class="btn btn-primary">Fiyat Teklifi Al</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- About Us Content Section End -->



<?php require_once('footer.php') ?>