<?php
session_start();
include("config.php");

if($_SESSION["status_login_admin"] != "true") {
    header("Location: index.php?pesan=belum_login");
}

if( isset($_GET['id']) ){

    // ambil id dari query string
    $id = $_GET['id'];

    // buat query hapus
    $sql = "DELETE FROM result_ujian WHERE id_siswa=$id";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?

    if($query){
        header('Location: dashboard.php');
    } else {
        die("Gagal menghapus...");
    }

} else {
    die("Akses dilarang...");
}

?>