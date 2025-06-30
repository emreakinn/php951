<?php require_once('header.php');

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];
    $urlSil = $db->prepare('delete from seoTalep where id=?');
    $urlSil->execute(array($id));

    if ($urlSil->rowCount()) {
        echo '<script> alert("Web Adresi Silindi") </script><meta http-equiv="refresh" content="0; url=seo-talepleri.php">';
    } else {
        echo '<script> alert("Hata Alındı") </script><meta http-equiv="refresh" content="0; url=seo-talepleri.php">';
    }
} else if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $urlMail = $db->prepare('select * from seoTalep where id=?');
    $urlMail->execute(array($id));
    $urlMailRow = $urlMail->fetch();

    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
            myModal.show();
        });
    </script>
    ';
}

?>
<!-- Admin Body Section Start -->
<div class="row">
    <div class="col-12">
        <h3>Seo Talepleri</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Web Sitesi Adresi</th>
                    <th class="text-end">Düzenle / Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $urlList = $db->prepare('select * from seoTalep order by id desc');
                $urlList->execute();

                if ($urlList->rowCount()) {
                    foreach ($urlList as $urlListRow) {
                ?>
                        <tr>
                            <td><a class="text-dark" href="mailto:<?php echo $urlListRow['url'] ?>"><?php echo $urlListRow['url'] ?></a></td>
                            <td class="text-end">
                                <a href="seo-talepleri.php?updateID=<?php echo $urlListRow['id'] ?>" target="blank" class="btn btn-warning">Düzenle</a>
                                <a href="seo-talepleri.php?deleteID=<?php echo $urlListRow['id'] ?>" class="btn btn-danger">Sil</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Admin Body Section End -->

<!-- Url Update Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seo Talep Url Güncelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="flexList gap-2">
                    <input type="url" name="urlUP" value="<?php echo $urlMailRow['url'] ?>" class="form-control">
                    <input type="submit" class="btn btn-success w-100" value="Güncelle" name="guncelle" class="form-control">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Url Update Modal End -->

<?php
if (isset($_POST['guncelle'])) {
    $urlGuncelle = $db->prepare('update seoTalep set url=? where id=?');
    $urlGuncelle->execute(array($_POST['urlUP'], $id));
    if ($urlGuncelle->rowCount()) {
        echo '<script> alert("Seo Maili Adresi Güncellendi") </script><meta http-equiv="refresh" content="0; url=seo-talepleri.php">';
    } else {
        echo '<script> alert("Hata Alındı") </script><meta http-equiv="refresh" content="0; url=seo-talepleri.php">';
    }
}
?>


<?php require_once('footer.php'); ?>