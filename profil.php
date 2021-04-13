<?php require_once "template/header.php";
if ($_SESSION['status'] != "login") {
    header("location:login.php");
}

$username = $_SESSION['username'];
$query      = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$data       = mysqli_fetch_assoc($query);
?>
<main>
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 70px">
            <div class="col-md-6">
                <?php if (isset($_GET['status'])) : ?>
                    <p>
                        <?php
                        if ($_GET['status'] == 'edit_berhasil') {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Edit profil <strong>berhasil!</strong>.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                        } else {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Gagal edit profil!</strong>.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                        }
                        ?>
                    </p>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        Profil
                    </div>
                    <div class="card-body">
                        <form action="proses.php" method="post">
                            <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input readonly type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input required type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" id="password" name="password" value="<?= $data['password'] ?>">
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="edit_profil">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<p style="margin-bottom: 70px;"></p>
<?php require_once "template/footer.php"; ?>