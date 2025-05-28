<?php require_once('header.php') ?>
<?php require_once('banner.php') ?>

<!-- Projeler Section Start -->
<section id="projeler">
    <div class="container">
        <div class="row py-5 gy-4">
            <?php
            $projeler = $db->prepare('select * from portfolyo order by id desc');
            $projeler->execute();

            if ($projeler->rowCount()) {
                foreach ($projeler as $projelerRow) {
            ?>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <img class="w-100" style="cursor: pointer;" src="<?php echo substr($projelerRow['gorsel'], 1) ?>" alt="<?php echo $projelerRow['projeAdi'] ?>" data-bs-toggle="modal" data-bs-target="#modal<?php echo $projelerRow['id'] ?>">
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modal<?php echo $projelerRow['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal<?php echo $projelerRow['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal<?php echo $projelerRow['id'] ?>"><?php echo $projelerRow['projeAdi'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img class="w-100" src="<?php echo substr($projelerRow['gorsel'], 1) ?>" alt="<?php echo $projelerRow['projeAdi']; ?>">
                                        <div class="row my-3">
                                            <div class="col-md-3"><b>Kurum:</b><br> <?php echo $projelerRow['projeAdi']; ?></div>
                                            <div class="col-md-3"><b>Proje Türü:</b><br> <?php echo $projelerRow['projeTuru']; ?></div>
                                            <div class="col-md-3"><b>Hizmet:</b><br> <?php echo $projelerRow['hizmet']; ?></div>
                                            <div class="col-md-3 mb-3"><b>Teknoloji:</b><br> <?php echo $projelerRow['teknoloji']; ?></div>
                                            <div class="col-12"><b>Açıklama:</b><br><?php echo $projelerRow['aciklama']; ?></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo $projelerRow['adres']; ?>" target="_blank"><button type="button" class="btn btn-primary">Ziyaret Et</button></a>
                                    </div>
                                </div>
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
<!-- Projeler Section End -->

<!-- Button trigger modal -->


<?php require_once('footer.php') ?>