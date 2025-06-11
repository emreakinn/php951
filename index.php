<?php require_once('header.php') ?>
<!-- Main banner section start -->
<section id="mainBanner">
    <div class="container kaanksss rounded-5" style="background: #f2f2f2;">
        <div class="row px-4">
            <div class="col-md-6">
                <h1>Banner Başlık Gelecek</h1>
                <p>Kısa Açıklama Gelecek</p>
                <div type="button" style="display: flex; align-items:center; column-gap:10px; padding:8px 0; width:30%; justify-content:center; border-radius:8px;" class="btn-purple" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tanıtım Videosu <i class="bi bi-play-circle-fill text-white"></i>
                </div>
            </div>
            <div class="col-md-6">
                Görsel Gelecek
                <img src="" alt="">
            </div>
        </div>
    </div>
</section>
<!-- Main banner section end -->

<!-- services section start -->
<section id="services" class="kaanksss">
    <div class="container">
        <div class="row">
            <?php
            $hizmetler = $db->prepare('select * from hizmetler order by baslik asc');
            $hizmetler->execute();
            if ($hizmetler->rowCount()) {
                foreach ($hizmetler as $hizmetlerRow) {
            ?>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <img src="<?php echo substr($hizmetlerRow['gorsel'], 1); ?>" alt="<?php echo $hizmetlerRow['baslik']; ?>">
                            <div class="card-body text-center">
                                <h2><?php echo $hizmetlerRow['baslik']; ?></h2>
                                <div class="my-3"><?php echo substr($hizmetlerRow['aciklama'], 0, 150) ?></div>
                                <a href="hizmetler.php?id=<?php echo $hizmetlerRow['id']; ?>" class="btn btn-purple">Daha Fazla Bilgi</a>
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
<!-- services section end -->

<!-- About us section Start -->
<section id="aboutUs" class="kaanksss">
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-auto">
                <?php
                $aboutUs = $db->prepare('select * from hakkimizda order by id desc limit 1');
                $aboutUs->execute();
                $aboutUsRow = $aboutUs->fetch();
                ?>
                <h3><?php echo $aboutUsRow['baslik']; ?></h3>
                <span class="fs-3">En İyi 360 Derece Dijital Ajans</span>
                <div class="my-3"><?php echo substr($aboutUsRow['aciklama'], 0, 600); ?></div>
                <a href="hakkimizda.php" class="btn btn-purple">Devamını Oku</a>
            </div>
            <div class="col-md-6 my-auto text-center">
                <img src="./assets/img/kaanksss-500x500.webp" alt="kaanksss" class="w-75">
            </div>
        </div>
    </div>
</section>
<!-- About us section End -->

<!-- Seo application section start -->
<section id="seoApp" class="py-5 bg-purple">
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center">
                <h3>Ücretsiz SEO Analizi</h3>
                <form action="" method="post" style="background-color: #fff; padding:8px 12px;" class="rounded">
                    <div class="social">
                        <input type="url" name="siteAdres" placeholder="Web Sitesi Adresinizi Girin" class="w-100" style="border: none; outline:none;">
                        <input type="submit" value="Gönder" name="seoApp" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Seo application section end -->

<!-- Pricing section start -->
<section id="pricing" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="fs-1">Size Uygun Hizmet Paketini Seçin</span>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card shadow text-center" style="border: none;">
                    <div class="card-header bg-transparent py-4">
                        <p>Paket Adı</p>
                        <span class="fs-2">Fiyat</span>
                    </div>
                    <div class="card-body">
                        <ol class="list-group">
                            <li class="list-group-item">1</li>
                            <li class="list-group-item">2</li>
                            <li class="list-group-item">3</li>
                            <li class="list-group-item">4</li>
                            <li class="list-group-item">5</li>
                        </ol>
                    </div>
                    <div class="card-footer bg-transparent py-4">
                        <a href="iletisim.php" class="btn bg-secondary-subtle w-100 py-3 fs-4">Başvur</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Pricing section end -->

<!-- Blog Sectin Start -->
<section id="mainBlog" class="kaanksss">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="fs-1">Güncel Blog Yazıları</h3>
                <p>Güncel Yazılım ve Teknoloji haberleri hakkında blog yazılarımızı okuyun</p>
            </div>
        </div>
        <div class="row my-3">
            <?php
            $makale = $db->prepare('select * from yazilar where durum="Yayında" order by id desc limit 3');
            $makale->execute();
            if ($makale->rowCount()) {
                foreach ($makale as $makaleRow) {
            ?>
                    <div class="col-md-4">
                        <a href="makale.php?postID=<?php echo $makaleRow['id']; ?>">
                            <div class="card shadow" style="min-height: 320px;">
                                <img src="<?php echo substr($makaleRow['gorsel'], 1); ?>" alt="<?php echo $makaleRow['baslik']; ?>">
                                <div class="card-body">
                                    <h2><?php echo $makaleRow['baslik']; ?></h2>
                                    <small>Yayın Tarihi: <?php echo $makaleRow['tarih']; ?></small>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="blog.php" class="btn btn-purple">Tümünü Okuyun</a>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
<?php require_once('footer.php') ?>