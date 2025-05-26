<?php require_once('header.php') ?>

<!-- Kategori Banner Section Start -->
<section id="kategoriBanner" class="banner">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <?php
                if (isset($_GET['katAdi'])) {
                ?>
                    <h1 class="display-1"><?php echo $_GET['katAdi'] ?></h1>
                    <small><a href="index.php" class="text-dark">Ana Sayfa</a> / <a href="blog.php" class="text-dark">Blog</a> / <?php echo $_GET['katAdi'] ?></small>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Kategori Banner Section End -->

<!-- Kategori List Section Start -->

<section id="kategoriList" class="py-5">
    <div class="container">
        <div class="row" style="row-gap:25px;">
            <?php
            if (isset($_GET['katAdi'])) {
                $katAdi = $_GET['katAdi'];
                $kategori = $db->prepare('select * from yazilar where kategori=? order by id desc');
                $kategori->execute(array($katAdi));

                if ($kategori->rowCount()) {
                    foreach ($kategori as $kategoriList) {
            ?>
                        <div class="col-md-4">
                            <a href="makale.php?postID=<?php echo $kategoriList['id'] ?>">
                                <div class="card">
                                    <img src="<?php echo substr($kategoriList['gorsel'], 1); ?>" alt="<?php echo $kategoriList['baslik']; ?>" class="card-img-top">
                                    <div class="card-body">
                                        <h2><?php echo $kategoriList['baslik'] ?></h2>
                                        <small>Yayın Tarihi : <?php echo $kategoriList['tarih']; ?></small>
                                    </div>
                                </div>
                            </a>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Kategori List Section End -->

<?php require_once('footer.php') ?>