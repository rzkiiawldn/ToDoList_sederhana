<?php require_once "template/header.php"; ?>

<main>
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 70px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Kegiatan hari ini
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 pr-4">
                            <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#exampleModal">
                                + Tambah Kegiatan
                            </button>
                        </div>
                        <div class="col-md-12">
                            <?php if (isset($_GET['status'])) : ?>
                                <p>
                                    <?php
                                    if ($_GET['status'] == 'berhasil_tambah_data') {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Selamat!</strong> Kegiatan berhasil ditambahkan.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                                    } elseif ($_GET['status'] == 'berhasil_hapus') {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Selamat!</strong> Kegiatan berhasil dihapus.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                                    } elseif ($_GET['status'] == 'berhasil_edit') {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Selamat!</strong> Kegiatan berhasil diedit.
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
                        $query      = mysqli_query($conn, "SELECT * FROM tb_kegiatan WHERE status_kegiatan = 0 ORDER BY jam ASC");
                        while ($kegiatan = mysqli_fetch_array($query)) { ?>
                            <blockquote class="blockquote mb-3 text-<?= $kegiatan['jenis_kegiatan'] == 'Normal' ? '' : 'danger'; ?>">
                                <p><?= $no++; ?>. <?= $kegiatan['kegiatan']; ?></p>
                                <p><?= $kegiatan['jam']; ?>.</p>
                                <footer class="blockquote-footer text-<?= $kegiatan['jenis_kegiatan'] == 'Normal' ? '' : 'danger'; ?>"><?= $kegiatan['jenis_kegiatan']; ?></footer>
                            </blockquote>
                            <form action="proses.php" method="post">
                                <input type="hidden" name="id_kegiatan" value="<?= $kegiatan['id_kegiatan'] ?>">
                                <button type="submit" href="" class="btn btn-sm btn-primary" name="selesai" onclick="return confirm('Apakah anda yakin sudah selesai ?')">selesai</button> |
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahKegiatan<?= $kegiatan['id_kegiatan'] ?>">edit</button> |
                                <a type="submit" href="proses.php?id_kegiatan=<?= $kegiatan['id_kegiatan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">hapus</a>
                            </form>
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
    <p style="margin-bottom: 200px"></p>
<?php } else { ?>
    <p style="margin-bottom: 50px"></p>
<?php } ?>

<!-- Modal tambah kegiatan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan</label>
                        <input type="text" class="form-control" id="kegiatan" autofocus="kegiatan" name="kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kegiatan">Jenis Kegiatan</label>
                        <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" required>
                            <option value="">- pilih -</option>
                            <option value="Normal">Normal</option>
                            <option value="Penting">Penting</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam Pelaksanaan</label>
                        <input type="time" class="form-control" id="jam" autofocus="jam" name="jam" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit kegiatan -->
<?php
$query              = mysqli_query($conn, "SELECT * FROM tb_kegiatan WHERE status_kegiatan = 0 ORDER BY id_kegiatan DESC");
while ($kegiatan    = mysqli_fetch_array($query)) { ?>
    <div class="modal fade" id="ubahKegiatan<?= $kegiatan['id_kegiatan'] ?>" tabindex="-1" aria-labelledby="ubahKegiatanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahKegiatanLabel">Tambah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="proses.php" method="post">
                        <input type="hidden" name="id_kegiatan" value="<?= $kegiatan['id_kegiatan'] ?>">
                        <div class="form-group">
                            <label for="kegiatan">Kegiatan</label>
                            <input type="text" class="form-control" id="kegiatan" autofocus="kegiatan" name="kegiatan" required value="<?= $kegiatan['kegiatan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kegiatan">Jenis Kegiatan</label>
                            <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" required>
                                <option value="">- pilih -</option>
                                <option value="Normal" <?= $kegiatan['jenis_kegiatan'] == 'Normal' ? 'selected' : ''; ?>>Normal</option>
                                <option value="Penting" <?= $kegiatan['jenis_kegiatan'] == 'Penting' ? 'selected' : ''; ?>>Penting</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jam">Jam Pelaksanaan</label>
                            <input type="time" class="form-control" id="jam" autofocus="jam" name="jam" required value="<?= $kegiatan['jam'] ?>">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?php require_once "template/footer.php"; ?>