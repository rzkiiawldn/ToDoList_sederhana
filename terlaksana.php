<?php require_once "template/header.php"; ?>

<main>
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 70px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Kegiatan Terlaksana
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (isset($_GET['status'])) : ?>
                                <p>
                                    <?php
                                    if ($_GET['status'] == 'selesai') {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Selamat!</strong> Kegiatan Sudah Terlaksana.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Gagal!</strong>.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                                    }
                                    ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php
                        $no = 1;
                        // ambil data dari tabel kegiatan
                        $query      = mysqli_query($conn, "SELECT * FROM tb_kegiatan WHERE status_kegiatan = 1 ORDER BY id_kegiatan DESC");
                        while ($kegiatan = mysqli_fetch_array($query)) { ?>
                            <blockquote class="blockquote mb-3">
                                <p><?= $no++; ?>. <?= $kegiatan['kegiatan']; ?></p>
                                <p><?= $kegiatan['jam']; ?>.</p>
                                <footer class="blockquote-footer text-<?= $kegiatan['jenis_kegiatan'] == 'Normal' ? '' : 'danger'; ?>"><?= $kegiatan['jenis_kegiatan']; ?></footer>
                            </blockquote>
                            <hr>
                        <?php } ?>
                        <?= "Total kegiatan : " . mysqli_num_rows($query); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php if (mysqli_num_rows($query) == 0) { ?>
    <p style="margin-bottom: 400px"></p>
<?php } else { ?>
    <p style="margin-bottom: 50px"></p>
<?php } ?>


<?php require_once "template/footer.php"; ?>