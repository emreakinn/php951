<?php require_once('header.php');

// Main Page settings start

$mainPageSet = $db->prepare('select * from anasayfa order by id desc limit 1');
$mainPageSet->execute();
$mainPageSetRow = $mainPageSet->fetch();

// Main Page settings start

?>
<!-- Main banner section start -->
<section id="mainBanner">
    <div class="container kaanksss rounded-5" style="background: #f2f2f2;">
        <div class="row px-4">
            <div class="col-md-6 my-auto">
                <h1><?php echo $mainPageSetRow['baslik']; ?></h1>
                <p><?php echo $mainPageSetRow['aciklama']; ?></p>
                <div type="button" style="display: flex; align-items:center; column-gap:10px; padding:8px 0; width:30%; justify-content:center; border-radius:8px;" class="btn-purple" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tanıtım Videosu <i class="bi bi-play-circle-fill text-white"></i>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sayfa Yüklendiğinde Gösterilen Modal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $mainPageSetRow['video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-auto">
                <img src="<?php echo substr($mainPageSetRow['gorsel'], 1); ?>" alt="<?php $mainPageSetRow['baslik']; ?>" class="w-100">
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

<?php
if (isset($_POST['seoApp'])) {
    $seoTalep = $db->prepare('insert into seotalep(url) values(?)');
    $seoTalep->execute(array($_POST['siteAdres']));

    if ($seoTalep->rowCount()) {
        echo '<script>alert("Talebiniz Alınmıştır")</script><meta http-equiv="refresh" content="0; url=index.php';
    } else {
        echo '<script>alert("Hata Alındı")</script><meta http-equiv="refresh" content="0; url=index.php';
    }
}
?>

<?php
// if (isset($_POST['seoApp'])) {
//     $url = urlencode($_POST['siteAdres']);
//     echo '<script>alert("Seo kontrolüne yönlendiriliyorsunuz")</script><meta http-equiv="refresh" content="0; url=https://freetools.seobility.net/en/seocheck/check?url=' . $url . '&crawltype=1">';
// }
?>
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
                        <p><?php echo $mainPageSetRow['paketAdi1']; ?></p>
                        <span class="fs-2"><?php echo $mainPageSetRow['fiyat1']; ?></span>
                    </div>
                    <div class="card-body">
                        <ol class="list-group">
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket1ozellik1']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket1ozellik2']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket1ozellik3']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket1ozellik4']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket1ozellik5']; ?></li>
                        </ol>
                    </div>
                    <div class="card-footer bg-transparent py-4">
                        <a href="iletisim.php" class="btn bg-secondary-subtle w-100 py-3 fs-4">Başvur</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow text-center" style="border: none;">
                    <div class="card-header bg-transparent py-4">
                        <p><?php echo $mainPageSetRow['paketAdi2']; ?></p>
                        <span class="fs-2"><?php echo $mainPageSetRow['fiyat2']; ?></span>
                    </div>
                    <div class="card-body">
                        <ol class="list-group">
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket2ozellik1']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket2ozellik2']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket2ozellik3']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket2ozellik4']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket2ozellik5']; ?></li>
                        </ol>
                    </div>
                    <div class="card-footer bg-transparent py-4">
                        <a href="iletisim.php" class="btn bg-secondary-subtle w-100 py-3 fs-4">Başvur</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow text-center" style="border: none;">
                    <div class="card-header bg-transparent py-4">
                        <p><?php echo $mainPageSetRow['paketAdi3']; ?></p>
                        <span class="fs-2"><?php echo $mainPageSetRow['fiyat3']; ?></span>
                    </div>
                    <div class="card-body">
                        <ol class="list-group">
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket3ozellik1']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket3ozellik2']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket3ozellik3']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket3ozellik4']; ?></li>
                            <li class="list-group-item"><?php echo $mainPageSetRow['paket3ozellik5']; ?></li>
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