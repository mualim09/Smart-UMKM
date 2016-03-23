<?php
include("admin/koneksi.php");
include("admin/func.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register | UMKM</title>


	 <!-- Bootstrap CSS -->
            <link href="assets/css/bootstrap.css" rel="stylesheet">
            <link href="assets/css/animate.css" rel="stylesheet">
            <link href="assets/css/font-awesome.css" rel="stylesheet">
            <link href="assets/css/bootstrap-datepicker.css" rel="stylesheet">
	
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs-block visible-sm-block" href="#"> SMART UMKM </a>
				<a class="navbar-brand hidden-xs hidden-sm" href="#">SMART UMKM </a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Beranda</a></li>
					<li class="active"><a href="registrasi.php">Tambah Data</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			
			<hr />
			
			<?php
			if(isset($_POST['add'])){
				$id_user		   = aman($_POST['id_user']);

				$pass1		       = aman($_POST['pass1']);
                $pass2             = aman($_POST['pass2']);
				$nama_umkm		   = aman($_POST['nama_umkm']);
				$nama_pemilik	   = aman($_POST['nama_pemilik']);
				$alamat		       = aman($_POST['alamat']);
				$jenis_usaha	   = aman($_POST['jenis_usaha']);
                
//				$jk			= aman($_POST['jk']);
//				$agama		= aman($_POST['agama']);
//				$jurusan	= aman($_POST['jurusan']);
//				$smt		= aman($_POST['semester']);
//				$thn_masuk	= aman($_POST['tahun_masuk']);
//				$alamat		= aman($_POST['alamat']);
//				$status		= aman($_POST['status']);
//				
				$cek = mysqli_query($koneksi, "SELECT * FROM login WHERE id_user='$id_user'");
				if(mysqli_num_rows($cek) == 0){
					if($pass1 == $pass2){
						$pass = md5($pass1);
						$insert = mysqli_query($koneksi, "INSERT INTO login(id_user, password, nama_umkm, nama_pemilik, alamat, jenis_usaha)
															VALUES('$id_user', '$pass', '$nama_umkm', '$nama_pemilik', '$alamat', '$jenis_usaha')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success">Pendaftaran berhasil dilakukan.</div>';
						}else{
							echo '<div class="alert alert-danger">Pendaftaran gagal dilakukan, silahkan coba lagi.</div>';
						}
					}else{
						echo '<div class="alert alert-danger">Konfirmasi Password tidak sesuai.</div>';
					}
				}else{
					echo '<div class="alert alert-danger">ID UMKM sudah terdaftar.</div>';
				}
			}
			?>
			
			<form class="form-horizontal animated bounceInUp" style="animation-delay: 1s;" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">ID UMKM</label>
					<div class="col-sm-3">
						<input type="text" name="id_user" class="form-control" placeholder="ID UMKM" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">PASSWORD</label>
					<div class="col-sm-3">
						<input type="password" name="pass1" class="form-control" placeholder="PASSWORD" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KONFIRMASI PASSWORD</label>
					<div class="col-sm-3">
						<input type="password" name="pass2" class="form-control" placeholder="KONFIRMASI PASSWORD" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA UMKM</label>
					<div class="col-sm-5">
						<input type="text" name="nama_umkm" class="form-control" placeholder="NAMA UMKM" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA PEMILIK</label>
					<div class="col-sm-5">
						<input type="text" name="nama_pemilik" class="form-control" placeholder="NAMA ANDA" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ALAMAT</label>
					<div class="col-sm-5">
						<input type="text" name="alamat" class="form-control" placeholder="ALAMAT" required>
					</div>
				</div>
				

				
				<div class="form-group">
					<label class="col-sm-3 control-label">JENIS USAHA</label>
					<div class="col-sm-3">
						<select name="jenis_usaha" class="form-control">
							<option value="">JENIS USAHA</option>
							<option value="Manufaktur">MANUFAKTUR</option>
							<option value="Dagang Barang">DAGANG BARANG</option>
							<option value="Dagang Makanan">DAGANG MAKANAN</option>
						</select>
					</div>
				</div>
				<div class="form-group animated swing" style="animation-delay: 1s;">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-primary" value="TAMBAH">
						<a href="index.php" class="btn btn-warning">BATAL</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	
	<script>
	$('.date').datepicker({
		format: 'yyyy-mm-dd',
	})
	</script>
</body>
</html>