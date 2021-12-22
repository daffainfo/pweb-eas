<!DOCTYPE html>
<html>
<head>
	<title>Login Teacher</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		#cover {
			position: relative;
		}

		#cover:before {
			content: ' ';
			display: block;
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			opacity: 0.25;
			background-image: url('https://www.its.ac.id/news/wp-content/uploads/sites/2/2020/12/WhatsApp-Image-2020-12-26-at-9.19.55-AM.jpeg');
			background-repeat: no-repeat;
			background-position: 50% 0;
			background-size: cover;
		}

		#cover-caption {
			width: 100%;
			position: relative;
			z-index: 1;
		}

		/* only used for background overlay not needed for centering */
		form:before {
			content: '';
			height: 100%;
			left: 0;
			position: absolute;
			top: 0;
			width: 100%;
			background-color: rgba(0,0,0,0.3);
			z-index: -1;
			border-radius: 10px;
		}

	</style>
</head>
<body>
	<?php
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan'] == 'gagal') {
				echo '<script>alert("Login gagal, cek ulang username / password")</script>';
			} else if ($_GET['pesan'] == 'berhasil_daftar') {
				echo '<script>alert("Berhasil Mendaftar")</script>';
			} else if ($_GET['pesan'] == 'logout') {
				echo '<script>alert("Berhasil logout")</script>';
			} else if ($_GET['pesan'] == 'belum_login') {
				echo '<script>alert("Silahkan login terlebih dahulu")</script>';
			}
		}
	?>
	<section id="cover" class="min-vh-100">
		<div id="cover-caption">
			<div class="container">
				<br>
				<br>
				<h1 class="display-4 mb-5 text-center">Login</h1>
				<br>
				<div class="row">
					<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
						<div class="px-2">
						<form action="cek_login.php" method="POST" class="justify-content-center">
							<div class="form-group">
								<h4>
									<label for="username">Username: </label>
								</h4>
								<input class="form-control" type="username" name="username">
							</div>
							<div class="form-group">
								<h4>
									<label for="password">Password: </label>
								</h4>
								<input class="form-control" type="password" name="password">
							</div>
							<button type="submit" class="btn btn-primary mt-4 mb-4">Submit</button>
							<br>
							<a class="text-dark h6" href="register.php">Belum punya akun? Daftar disini</a>
						</form>
						</div>
					</div>
				</div>
				<footer>
					<br>
					<h6 class="text-center mt-5">Made by Muhammad Daffa</h6>
				</footer>
			</div>
		</div>
	</section>
</body>
</html>