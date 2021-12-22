<?php
session_start();
error_reporting(0);
include("config.php");

if($_SESSION["status_login_admin"] != "true") {
    header("Location: index.php?pesan=belum_login");
}

$result=mysqli_query($db, "SELECT count(*) as total from soal");
$data=mysqli_fetch_assoc($result);
$jumlah_soal = $data['total'];

$nilai_arr = array("");

$z = 1;
while($z <= $jumlah_soal) {
    $sql_soal = "SELECT * FROM soal";
    $query_soal = mysqli_query($db, $sql_soal);

    $sql_result = "SELECT * FROM result_ujian where id_siswa=$z";
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
    array_push($nilai_arr,round($nilai/$jumlah_soal * 100,2));
    // $persentasi=;
    $z++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Teacher</title>
    <meta charset="UTF-8">
    <meta name="author" content="Muhammad Daffa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        footer {
            margin-top: 180px;
        }
    </style>
</head>

<body>
    <a href="logout.php" type="button" class="btn btn-danger float-right mr-5">Logout</a>
    <div class="container">
        <header>
            <h1 class="text-center mt-5">Dashboard Teacher</h1>
        </header>
        <?php
            $uname = $_SESSION["username_admin"];
            $sql_admin = "SELECT * FROM admin where username='$uname'";
            $query_admin = mysqli_query($db, $sql_admin);
            while($admin = mysqli_fetch_array($query_admin)){
                echo "<img src='images/".$admin['file_name']."' class='mx-auto d-block img-thumbnail mt-5' width='100' height='100'>";
                echo "<h4 class='text-center mb-5'>Halo, ".$admin['nama']."!</h4>";
            }
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Nilai</th>
                    <th scope="col">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_siswa = "SELECT * FROM result_ujian INNER JOIN siswa ON result_ujian.id_siswa=siswa.id;";
                $query_siswa = mysqli_query($db, $sql_siswa);
                // echo $arr2[0];
                // if ($arr[1] != "") {
                    // $loop = 1;
                    while($siswa = mysqli_fetch_array($query_siswa)){
                        echo "<tr>";
                        echo "<td>".$siswa['id']."</td>";
                        echo "<td>".$siswa['nama']."</td>";
                        echo "<td>".$siswa['jenis_kelamin']."</td>";
                        echo "<td>".$nilai_arr[$siswa['id']]."</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=".$siswa['id']."'>Edit</a> | ";
                        echo "<a href='hapus.php?id=".$siswa['id']."'>Hapus</a> | ";
                        echo "<a href='detail.php?id=".$siswa['id']."'>Detail</a> | ";
                        echo "<a href='print.php?id=".$siswa['id']."'>Print</a>";
                        echo "</td>";
                        echo "</tr>";
                        // $loop++;
                    }
                // }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <h6 class="text-center">Made by Muhammad Daffa</h6>
    </footer>
</body>
</html>