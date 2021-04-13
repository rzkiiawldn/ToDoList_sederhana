<?php require_once "koneksi.php" ?>
<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:login.php");
}

$username = $_SESSION['username'];
$query      = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$data       = mysqli_fetch_assoc($query);
$id_user    = $data['id_user'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>ToDoList!</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">ToDoList</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="terlaksana.php">Terlaksana</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $data['nama']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profil.php">Edit Profil</a>
                            <a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin keluar ?')">Keluar</a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>