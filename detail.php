<?php
session_start();
include("config.php");

if($_SESSION["status_login_admin"] != "true") {
    header("Location: index.php?pesan=belum_login");
}
// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
    header('Location: dashboard.php');
}

//ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql_siswa = "SELECT * FROM siswa WHERE id=$id";
$query_siswa = mysqli_query($db, $sql_siswa);
$result_siswa = mysqli_fetch_assoc($query_siswa);

$result_count=mysqli_query($db, "SELECT count(*) as total from soal");
$data=mysqli_fetch_assoc($result_count);
$jumlah_soal = $data['total'];

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query_siswa) < 1 ){
    die("data tidak ditemukan...");
}

$sql_soal = "SELECT * FROM soal";
$query_soal = mysqli_query($db, $sql_soal);

$sql_result = "SELECT * FROM result_ujian where id_siswa=$id";
$query_result = mysqli_query($db, $sql_result);

$arr=array("");
$arr2=array("");

while($soal = mysqli_fetch_array($query_soal)){
    while($result = mysqli_fetch_array($query_result)){
        $i = 0;
        while($i <= strlen($result['lembar_ujian'])) {
            array_push($arr,$result['lembar_ujian'][$i]);
            $i = $i + 2;
        }
        
    }
    array_push($arr2,$soal['jawaban_benar']);
}

$i = 1;
$nilai = 0;
while($i <= $jumlah_soal) {
    if ($arr[$i] == $arr2[$i]) {
        $nilai++;
    }
    $i++;
}
$persentasi=round($nilai/$jumlah_soal * 100,2);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Detail Siswa</title>
    <meta charset="UTF-8">
    <meta name="author" content="Muhammad Daffa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 text-center">Detail Nilai</h1>
        <h1 class="mt-2 text-center"><?php echo $result_siswa['nama'] ?></h1>
            <?php
                $count = 0;
                $sql_soal = "SELECT * FROM soal";
                $query_soal = mysqli_query($db, $sql_soal);
                while($soal = mysqli_fetch_array($query_soal)):
            ?>
        <form>
            <fieldset class="form-group">
                <h4 class='mt-5'><?php echo $soal['soal'] ?></h4>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' id='pilihan_1' name='<?php echo $soal['nomor'] ?>' value='A' <?php echo ($arr[$count + 1] == 'A') ? "checked" : "" ?>>
                    <label class='form-check-label' for='pilihan_1'><?php echo $soal['pilihan_1'] ?></label>
                </div>
                <div class='form-check'>    
                    <input class='form-check-input' type='radio' id='pilihan_2' name='<?php echo $soal['nomor'] ?>' value='B' <?php echo ($arr[$count + 1] == 'B') ? "checked" : "" ?>>
                    <label class='form-check-label' for='pilihan_2'><?php echo $soal['pilihan_2'] ?></label>
                </div>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' id='pilihan_3' name='<?php echo $soal['nomor'] ?>' value='C' <?php echo ($arr[$count + 1] == 'C') ? "checked" : "" ?>>
                    <label class='form-check-label' for='pilihan_3'><?php echo $soal['pilihan_3'] ?></label>
                </div>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' id='pilihan_4' name='<?php echo $soal['nomor'] ?>' value='D'<?php echo ($arr[$count + 1] == 'D') ? "checked" : "" ?>>
                    <label class='form-check-label' for='pilihan_4'><?php echo $soal['pilihan_4'] ?></label>
                </div>
            </fieldset>
            <?php $count++ ?>
            <?php endwhile; ?>   
        </form>
    </div>
</body>
</html>