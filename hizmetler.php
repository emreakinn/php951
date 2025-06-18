<?php require_once('header.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hizmet = $db->prepare('select * from hizmetler where id=?');
    $hizmet->execute(array($id));
    $hizmetRow = $hizmet->fetch();
}
?>

<!-- Services Banner Start -->
<section id="banner<?php echo $id ?>" style="background: url(<?php echo substr($hizmetRow['gorsel'], 1); ?>);" class="banner text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1><?php echo $hizmetRow['baslik'] ?></h1>
                <small><a href="index.php" class="text-white">Ana Sayfa</a> / <?php echo $hizmetRow['baslik'] ?></small>
            </div>
        </div>
    </div>
</section>
<!-- Services Banner End -->

<!-- Content section start -->
<section id="content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php echo $hizmetRow['aciklama'] ?>
            </div>
        </div>
    </div>
</section>
<!-- Content section end -->

<!-- Cta section start -->
<section id="cta" class="py-5 text-center bg-secondary-subtle">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <span class="fs-1">Hızlı ve Kaliteli Hizmet İçin <br> Hemen Arayın</span>
            </div>
            <div class="col-md-3 my-auto">
                <a href="tel:+905555555555" class="btn btn-warning">Hemen Arayın</a>
            </div>
        </div>
    </div>
</section>
<!-- Cta section end -->

<?php require_once('footer.php') ?>