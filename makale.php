<?php require_once('header.php');

if (isset($_GET['postID'])) {
    $id = $_GET['postID'];
    $article = $db->prepare('select * from yazilar where id=?');
    $article->execute(array($id));
    $articleSatir = $article->fetch();
}

?>

<!-- Content Section Start -->

<section id="article" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <!-- breadcrumb start -->
                <div class="mb-3">
                    <a href="index.php">Ana Sayfa</a> / <a href="blog.php">Blog</a> / <?php echo $articleSatir['baslik']; ?>
                </div>
                <!-- breadcrumb end -->
                <img src="<?php echo substr($articleSatir['gorsel'], 1); ?>" alt="<?php echo $articleSatir['baslik']; ?>" class="border shadow w-100">
                <div class="my-4">
                    <h1><?php echo $articleSatir['baslik']; ?></h1>
                    <small>Tarih : <?php echo $articleSatir['tarih']; ?> / XX Yorum</small>
                </div>
                <?php echo $articleSatir['aciklama']; ?>
            </div>
            <?php
            require_once('aside.php')
            ?>
        </div>
    </div>
</section>

<!-- Content Section End -->

<?php require_once('footer.php') ?>