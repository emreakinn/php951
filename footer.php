    <!-- 
     $ayarlarRow header.php de oluşturuldu
    -->

    <!-- Footer Section Start -->
    <footer id="footer" class="bg-dark pt-5">
        <section id="topFooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo substr($ayarlarRow['logo'], 1); ?>" alt="Arı Bilişim Logo" class="w-50">
                        <div>
                            <small>
                                <?php echo $ayarlarRow['kisaAciklama']; ?>
                            </small>
                        </div>
                        <div class="social my-4">
                            <a href="<?php echo $ayarlarRow['facebook']; ?>"><i class="bi bi-facebook"></i></a>
                            <a href="<?php echo $ayarlarRow['instagram']; ?>"><i class="bi bi-instagram"></i></a>
                            <a href="<?php echo $ayarlarRow['twitter']; ?>"><i class="bi bi-twitter"></i></a>
                            <a href="<?php echo $ayarlarRow['linkedin']; ?>"><i class="bi bi-linkedin"></i></a>
                            <a href="https://wa.me/+9<?php echo $ayarlarRow['wp']; ?>"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>aribilisim.com</h5>
                        <div class="footerMenu">
                            <a href="index.php">Ana Sayfa</a>
                            <a href="hakkimizda.php">Hakkımızda</a>
                            <a href="portfolyo.php">Portfolyo</a>
                            <a href="#hizmetler">Hizmetler</a>
                            <a href="blog.php">Blog</a>
                            <a href="iletisim.php">İletişim</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Bize Ulaşın</h5>
                        <small>
                            <?php echo $ayarlarRow['adres'] ?> <br>
                            Tel: <a href="tel:<?php echo $ayarlarRow['telefon'] ?>"><?php echo $ayarlarRow['telefon'] ?></a> <br>
                            E-Posta: <a href="mailto:<?php echo $ayarlarRow['eposta'] ?>"><?php echo $ayarlarRow['eposta'] ?></a>
                        </small>
                    </div>
                    <div class="col-md-3">
                        <h5>E-Bültene Üye Olun</h5>
                        <small>Güncel blog yazıları ve teknoloji haberleri hakkında bilgi almak için e-bültenimize üye olun</small>
                        <form action="" method="post" class="mt-3">
                            <input type="email" name="eposta" placeholder="E-Posta Adresiniz" class="form-control mb-1">
                            <input type="submit" name="uyeOl" value="Üye Ol" class="btn btn-success w-100">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id="bottomFooter" class="py-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <small>Her Hakkı Saklıdır &copy; 2025. Bu web sitesi <a href="https://www.emreakin.com">Emre Akın</a> tarafından hazırlanmıştır</small>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <!-- Footer Section End -->

    <!-- E-Bülten Üye Ol Kyadet Module Start -->
    <?php
    if (isset($_POST['uyeOl'])) {
        $uyeOl = $db->prepare('insert into ebulten(eposta) values(?)');
        $uyeOl->execute(array($_POST['eposta']));

        if ($uyeOl->rowCount()) {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    let toastEl = document.getElementById("liveToast");
                    let toast = new bootstrap.Toast(toastEl, {
                    delay: 2000 // 2 saniye görünür
                    });

                    toast.show();

                    toastEl.addEventListener("hidden.bs.toast", function () {
                    window.location.href = "index.php";
                    });
                });
            </script>';
        }
    }
    ?>
    <div class="position-fixed" style="z-index: 1100; right:40%; top:50px;">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="./assets/img/ikon-logo.png" class="rounded me-2" alt="...">
                <strong class="me-auto">Arı Bilişim</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Kaydınız Başarılı
            </div>
        </div>
    </div>
    <!-- E-Bülten Üye Ol Kyadet Module End -->

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>