<?php

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
} elseif (isset($_POST['tambah'])) {
    // Ambil data dari form input
    $id_user            = 1;
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
}
