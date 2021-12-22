<?php
include("config.php");

$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $nama = $_POST['nama'];
    $username = $_POST['username'];
	$password = $_POST['password'];

    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // buat query
            $sql = "INSERT INTO admin (nama, username, password, file_name) VALUE ('$nama', '$username', '$password', '$fileName')";
            $query = mysqli_query($db, $sql);

            // apakah query simpan berhasil?
            if( $query ) {
                // kalau berhasil alihkan ke halaman index.php dengan status=sukses
                header('Location: index.php?pesan=berhasil_daftar');
            } else {
                // kalau gagal alihkan ke halaman indek.php dengan status=gagal
                header('Location: register.php?pesan=gagal_daftar');
            }
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
    }else{
        echo 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
} else {
    die("Akses dilarang...");
}
