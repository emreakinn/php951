<?php
require_once('./assets/baglan.php');

/* Ayarlar Select Module Start */
$ayarlar = $db->prepare('select * from ayarlar order by id desc limit 1');
$ayarlar->execute();
$ayarlarRow = $ayarlar->fetch();
/* Ayarlar Select Module End */

/* Digital COdes Select Module Start */
$dijital = $db->prepare('select * from dijital order by id desc limit 1');
$dijital->execute();
$dijitalRow = $dijital->fetch();
/* Digital COdes Select Module End */
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">

    <!-- Css Files -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google Search Console Code Start -->
    <meta name="google-site-verification" content="<?php echo $dijitalRow['console']; ?>" />
    <!-- Google Search Console Code End -->

    <!-- Google Analytics Code Start -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $dijitalRow['analitik']; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '<?php echo $dijitalRow["analitik"]; ?>');
    </script>
    <!-- Google Analytics Code End -->

    <!-- Facebook Pixel Code Start -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '<?php echo $dijitalRow["pixel"]; ?>');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=<?php echo $dijitalRow['pixel']; ?>&ev=PageView&noscript=1" />
    </noscript>
    <!-- Facebook Pixel Code End -->

    <title>Document</title>
</head>

<body>

    <!-- Header Section Start -->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.php">
                                <img src="./assets/img/logo.webp" alt="Arı Bilişim Logo" class="w-25">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav ms-auto">
                                    <a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a>
                                    <a class="nav-link" href="hakkimizda.php">Hakkımızda</a>
                                    <a class="nav-link" href="portfolyo.php">Portfolyo</a>
                                    <a class="nav-link" href="index.php#services">Hizmetler</a>
                                    <a class="nav-link" href="blog.php">Blog</a>
                                    <a class="nav-link" href="iletisim.php">İletişim</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->