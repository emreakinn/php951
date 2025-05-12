<?php require_once('header.php') ?>

<!-- Blog Banner Section Start -->
<section id="blogBanner" class="banner">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-1">Blog</h1>
                <small><a href="index.php" class="text-dark">Ana Sayfa</a> / Blog </small>
            </div>
        </div>
    </div>
</section>
<!-- Blog Banner Section End -->

<!-- Search Section Start -->

<section id="blogSearch" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="get">
                    <input type="search" name="ara" placeholder="Site içi blog arama" class="form-control">
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Search Section End -->

<!-- Blog List Section Start -->

<section id="blogList" class="py-5">
    <div class="container">
        <div class="row" style="row-gap:25px;">
            <?php
            $blogList = $db->prepare('select * from yazilar where durum="Yayında" order by id desc');
            $blogList->execute();

            if ($blogList->rowCount()) {
                foreach ($blogList as $blogListSatir) {
            ?>
                    <div class="col-md-4">
                        <a href="makale.php?postID=<?php echo $blogListSatir['id']; ?>">
                            <div class="card shadow">
                                <img src="<?php echo substr($blogListSatir['gorsel'], 1); ?>" alt="<?php echo $blogListSatir['baslik']; ?>" class="card-img-top">
                                <div class="card-body">
                                    <h2><?php echo $blogListSatir['baslik']; ?></h2>
                                    <small>Yayın Tarihi : <?php echo $blogListSatir['tarih']; ?></small>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Blog List Section End -->

<?php require_once('footer.php') ?>