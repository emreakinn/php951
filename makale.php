<?php require_once('header.php');

if (isset($_GET['postID'])) {
    $id = $_GET['postID'];
    $article = $db->prepare('select * from yazilar where id=?');
    $article->execute(array($id));
    $articleSatir = $article->fetch();
} else {
    echo '<meta http-equiv="refresh" content="0; url=blog.php">';
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

                <!-- Yorum Alanı Start -->

                <div class="mt-3">
                    <h3>Yorumlar</h3>
                    <b>VT den bilgi çek</b>
                </div>
                <hr>
                <div class="w-75">
                    <h3>Yorum Yapın</h3>
                    <form action="" method="post" class="row px-3" style="row-gap: 10px;">
                        <input type="text" name="isim" placeholder="Adınız Soyadınız" class="form-control" required>
                        <input type="email" name="eposta" placeholder="E-Mail Adresiniz" class="form-control" required>
                        <textarea name="yorum" placeholder="Yorumunuz" rows="5" class="form-control"></textarea>
                        <input type="hidden" name="blogAdi" value="<?php echo $articleSatir['baslik'] ?>">
                        <input type="submit" name="yorumYap" value="Gönder" class="btn btn-success" required>
                    </form>
                </div>

                <!-- Yorum Alanı End -->

            </div>
            <?php
            require_once('aside.php')
            ?>
        </div>
    </div>
</section>

<!-- Content Section End -->

<?php require_once('footer.php') ?>