<?php
$conn = mysqli_connect("localhost", "root", "", "db_todo");

// setting timer

$lama = 1; // lama data adalah 1 hari

// proses penghapusan data

$query = "DELETE FROM tb_kegiatan
          WHERE DATEDIFF(CURDATE(), date_created) > $lama";
$hasil = mysqli_query($conn, $query);
