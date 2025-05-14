<div class="col-md-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="" method="get">
                        <input type="search" name="ara" placeholder="Kelime Girin..." class="form-control mb-3">
                        <input type="submit" name="find" value="Ara" class="btn btn-purple w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-purple">Bizi Takip Edin</h3>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    <a href=""><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-purple">Kategoriler</h3>
                    <div class="flexList">
                        <?php
                        $katList = $db->prepare('select distinct kategori from yazilar');
                        $katList->execute();

                        if ($katList->rowCount()) {
                            foreach ($katList as $katListSatir) {
                        ?>
                                <a href="kategori.php?katAdi=<?php echo $katListSatir['kategori']; ?>"><?php echo $katListSatir['kategori']; ?></a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-purple">Son Yazılar</h3>
                    <div class="flexList">
                        <?php
                        $yaziList = $db->prepare('select * from yazilar order by id desc limit 5');
                        $yaziList->execute();

                        if ($yaziList->rowCount()) {
                            foreach ($yaziList as $yaziListSatir) {
                        ?>
                                <a href="makale.php?postID=<?php echo $yaziListSatir['id']; ?>"><?php echo $yaziListSatir['baslik']; ?></a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <img src="./assets/img/reklam.jpg" alt="Arı Bilişim Reklam Alanı" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="w-100" style="cursor:pointer;">

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" class="row px-3" style="row-gap: 10px;" enctype="multipart/form-data">
                                        <input type="text" name="isim" placeholder="Adınız Soyadınız" class="form-control" required>
                                        <input type="tel" name="telefon" placeholder="Telefon Numaranız" class="form-control" required>
                                        <input type="email" name="eposta" placeholder="E-Posta Adresiniz" class="form-control" required>
                                        <input type="url" name="adres" placeholder="Web Sitesi Adresiniz" class="form-control" required>
                                        <input type="file" name="gorsel" class="form-control" required>
                                        <input type="submit" name="reklam" value="Başvur" class="btn btn-purple">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ads Başvur Add Modul Start -->

<?php

if (isset($_POST['reklam'])) {
    $gorsel = './assets/img/' . $_FILES['gorsel']['name'];
    if (move_uploaded_file($_FILES['gorsel']['tmp_name'], $gorsel)) {
        $reklamTalep = $db->prepare('insert into reklam_talep(isim, telefon, eposta, adres, gorsel) values(?,?,?,?,?)');
        $reklamTalep->execute(array($_POST['isim'], $_POST['telefon'], $_POST['eposta'], $_POST['adres'], $gorsel));

        if ($reklamTalep->rowCount()) {
            echo '<script> alert("En Kısa Zamanda Aranacaksınız") </script><meta http-equiv="refresh" content="0; url=makale.php?postID=' . $id . '">';
        } else {
            echo '<script> alert("Hata Oluştu Tekrar Deneyin") </script><meta http-equiv="refresh" content="0; url=makale.php?postID=' . $id . '">';
        }
    }
}

?>
<!-- Ads Başvur Add Modul End -->