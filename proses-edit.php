<?php
session_start();
include("config.php");

if($_SESSION["status_login_admin"] != "true") {
    header("Location: index.php?pesan=belum_login");
}

$lembar_ujian = '';

// $sql = "SELECT * FROM result_ujian WHERE id_siswa=$id";
// $query = mysqli_query($db, $sql);
// $siswa = mysqli_fetch_assoc($query);

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $id = $_POST['id'];
    $soal1 = $_POST['soal_1'];
    $soal2 = $_POST['soal_2'];
    $soal3 = $_POST['soal_3'];
    $soal4 = $_POST['soal_4'];
    $soal5 = $_POST['soal_5'];

    $lembar_ujian = $soal1.",".$soal2.",".$soal3.",".$soal4.",".$soal5;

    // buat query update
    $sql = "UPDATE result_ujian SET lembar_ujian='$lembar_ujian' WHERE id_siswa=$id";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
    // kalau berhasil alihkan ke halaman dashboard.php
        header('Location: dashboard.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
} else {
    die("Akses dilarang...");
}
?>