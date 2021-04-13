<?php
// mengaktifkan session php
session_start();
require_once "koneksi.php";
// Cek tombol tambah
if (isset($_POST['registrasi'])) {
    // Ambil data dari form input
    $nama         = $_POST['nama'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];

    // buat query tambah data
    $sql = "INSERT INTO tb_user (`nama`, `username`, `password`) VALUE ('$nama', '$username', '$password')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: login.php?status=registrasi_berhasil');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: registrasi.php?status=gagal_registrasi');
    }
} elseif (isset($_POST['login'])) {
    $username       = $_POST['username'];
    $password       = $_POST['password'];
    // membuat query tampil data dan menyeleksi apakah username dan password yang dimasukan sesuai atau tidak
    $query          = mysqli_query($conn, "select * from tb_user where username = '$username' and password = '$password' ");
    // setelah di query, lalu hitung jumlah yg dimasukan, apakah data yg dimasukan ada atau tidak
    // jika datanya ada
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['username']   = $username;
        $_SESSION['status']     = "login";
        header('Location: index.php');
    } else {
        header('Location: login.php?status=gagal_login');
    }
} elseif (isset($_POST['tambah'])) {
    // Ambil data dari form input
    $id_user            = $_POST['id_user'];
    $kegiatan           = $_POST['kegiatan'];
    $jam                = $_POST['jam'];
    $jenis_kegiatan     = $_POST['jenis_kegiatan'];
    $status_kegiatan    = 0;
    $date_created       = date('Y-m-d');

    // buat query tambah data
    $sql = "INSERT INTO tb_kegiatan (id_user, kegiatan, jam, jenis_kegiatan, status_kegiatan, date_created) VALUE ('$id_user', '$kegiatan', '$jam', '$jenis_kegiatan', '$status_kegiatan' , '$date_created')";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if ($query) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: index.php?status=berhasil_tambah_data');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: index.php?status=gagal');
    }
} elseif (isset($_GET['id_kegiatan'])) {

    // ambil id_kegiatan dari query string
    $id_kegiatan = $_GET['id_kegiatan'];

    // buat query hapus
    $sql = "DELETE FROM tb_kegiatan WHERE id_kegiatan=$id_kegiatan";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: index.php?status=berhasil_hapus');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: index.php?status=gagal');
    }
} elseif (isset($_POST['selesai'])) {
    $id_kegiatan        = $_POST['id_kegiatan'];
    $status_kegiatan    = 1;
    $sql = "UPDATE tb_kegiatan SET status_kegiatan='$status_kegiatan' WHERE id_kegiatan=$id_kegiatan";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: terlaksana.php?status=selesai');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: index.php?status=gagal');
    }
} elseif (isset($_POST['edit'])) {
    $id_kegiatan        = $_POST['id_kegiatan'];
    $kegiatan           = $_POST['kegiatan'];
    $jam                = $_POST['jam'];
    $jenis_kegiatan     = $_POST['jenis_kegiatan'];
    $status_kegiatan    = 0;
    $sql = "UPDATE tb_kegiatan SET kegiatan='$kegiatan', jam='$jam', jenis_kegiatan='$jenis_kegiatan', status_kegiatan='$status_kegiatan' WHERE id_kegiatan=$id_kegiatan";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: index.php?status=berhasil_edit');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: index.php?status=gagal');
    }
} elseif (isset($_POST['edit_profil'])) {
    $id_user        = $_POST['id_user'];
    $nama           = $_POST['nama'];
    $username       = $_POST['username'];
    $password       = $_POST['password'];
    $sql = "update tb_user set nama='$nama', username='$username', password='$password' where id_user=$id_user";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: profil.php?status=edit_berhasil');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: profil.php?status=gagal');
    }
}
