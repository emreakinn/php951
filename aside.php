<div class="col-md-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="" method="get">
                        <input type="search" name="ara" placeholder="Kelime Girin..." class="form-control mb-3">
                        <input type="submit" value="Ara" class="btn btn-purple w-100">
                    </form>
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
</div>