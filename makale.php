<?php require_once('header.php');

if (isset($_GET['postID'])) {
    $id = $_GET['postID'];

    if ($id != '') {
        $article = $db->prepare('select * from yazilar where id=?');
        $article->execute(array($id));
        $articleSatir = $article->fetch();
    } else {
        echo '<meta http-equiv="refresh" content="0; url=blog.php">';
    }
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
                    <?php

                    if (isset($_GET['postID'])) {
                        $id = $_GET['postID'];

                        $yorumCek = $db->prepare('select * from yorumlar where yaziID=? and durum="Onaylandı"');
                        $yorumCek->execute(array($id));

                        if ($yorumCek->rowCount()) {
                            foreach ($yorumCek as $yorumCekSatir) {
                    ?>
                                <b><?php echo $yorumCekSatir['isim']; ?></b>
                                <p><?php echo $yorumCekSatir['yorum']; ?></p>
                                <hr>
                    <?php
                            }
                        }
                    }

                    ?>
                </div>
                <div class="w-75">
                    <h3>Yorum Yapın</h3>
                    <form action="" method="post" class="row px-3" style="row-gap: 10px;">
                        <input type="text" name="isim" placeholder="Adınız Soyadınız" class="form-control" required>
                        <input type="email" name="eposta" placeholder="E-Mail Adresiniz" class="form-control" required>
                        <textarea name="yorum" placeholder="Yorumunuz" rows="5" class="form-control"></textarea>
                        <input type="hidden" name="blog" value="<?php echo $articleSatir['id']; ?>">
                        <input type="submit" name="yorumYap" value="Gönder" class="btn btn-success">
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

<!-- Yorum Add Module Start -->

<?php

if (isset($_POST['yorumYap'])) {
    $yorumEKle = $db->prepare('insert into yorumlar(isim, eposta, yorum, yaziID, baslik, durum) values(?,?,?,?,?,?)');
    $yorumEKle->execute(array($_POST['isim'], $_POST['eposta'], $_POST['yorum'], $_POST['blog'], $articleSatir['baslik'], 'Onaylanmadı'));

    if ($yorumEKle->rowCount()) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function () {
        let toastEl = document.getElementById("liveToast");
        let toast = new bootstrap.Toast(toastEl, {
        delay: 2000 // 2 saniye görünür
    });

        toast.show();

        toastEl.addEventListener("hidden.bs.toast", function () {
        window.location.href = "makale.php?postID=' . $articleSatir['id'] . '";
    });
  });
</script>';
    }
}

?>

<!-- Yorum Add Module End -->

<div class="position-fixed p-3" style="z-index: 1100; right:40%; top:50px;">
    <div id="liveToast" class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Yorumunuz Admin Onayına Gönderildi
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Kapat"></button>
        </div>
    </div>
</div>

<?php require_once('footer.php') ?>