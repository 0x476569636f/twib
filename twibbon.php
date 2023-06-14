<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- SweetAlert JS -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<title>BSI Twibbon</title>
	<meta name="description" content="Bina Sarana Indormatika twibbon Maker">
	<meta name="keyword" content="BSI, BSI Twibbon Maker, twibbon Maker">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Courgette&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
	<!-- Google reCAPTCHA -->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<style>
		body, head {
			background-image: url('https://gcdnb.pbrd.co/images/qMyTjzHQiQmB.jpg');
			background-size: cover;
			font-family: 'Playfair Display';
		}
	</style>
</head>
<body>
	<!-- Hidden images untuk template twibbon -->
	<img src="twibbon1.png" id="twibbon1" width="1000px" height="1000px" hidden="true" class="img-fluid">
	<img src="twibbon2.png" id="twibbon2" width="1000px" height="1000px" hidden="true" class="img-fluid">
	<img src="twibbon3.png" id="twibbon3" width="1000px" height="1000px" hidden="true" class="img-fluid">
	<img src="twibbon4.png" id="twibbon4" width="1000px" height="1000px" hidden="true" class="img-fluid">
	<img src="twibbon5.png" id="twibbon5" width="1000px" height="1000px" hidden="true" class="img-fluid">
	<!-- Navbar -->
	<nav class="navbar navbar-light bg-white shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="./assets/nav.png">
				<img src="./assets/nav.png" width="35" height="35">
				<span class="navbar-brand mb-0 h1">BSI Twibbon Maker</span>
			</a>
		</div>
	</nav>
	<div class="container my-5">
		<div class="row">
			<!-- Card untuk form -->
			<div class="col-lg-6 offset-lg-3 col-md-12 mb-4">
				<div class="card card-body shadow-sm mb-4">
					<?php
						// Form submission handling
						if (isset($_POST['submit']))
						{
							$namafile       = $_FILES["file"]["name"];
							$filegambar     = substr($namafile, 0, strripos($namafile, '.'));
							$ekstensifile   = substr($namafile, strripos($namafile, '.'));
							$ukuranfile     = $_FILES["file"]["size"];
							$jenisfile      = array('.jpg','.jpeg','.png', '.JPG','.JPEG','.PNG');

							if (!empty($filegambar))
							{
								if ($ukuranfile <= 5000000)
								{
									if (in_array($ekstensifile, $jenisfile) && ($ukuranfile <= 5000000))
									{
										$namabaru = time().'_'.uniqid().'_n'.$ekstensifile;
										if (file_exists("images/" . $namabaru))
										{
											echo '<script>';
											echo 'swal("Error!", "Terjadi kesalahan silahkan coba lagi", "error").then(() => {
												window.location.href = "index.html";
											});';
										echo '</script>';
										exit;
									}
									else
									{       
										move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $namabaru);
										$gambar = "images/" . $namabaru;

										// Menampilkan image dan canvas
										echo '<img src="'.$gambar.'" id="img1" width="1000px" height="1000px" hidden="true" class="img-fluid">';
										echo '<img src="" id="img2" width="1000px" height="1000px" hidden="true" class="img-fluid">';
										echo '<h2><canvas id="canvas" class="img-fluid"></canvas></h2>';
									}
								}
								else
								{
									echo '<script>';
									echo 'swal("Error!", "File harus gambar", "error").then(() => {
										window.location.href = "index.html";
									});';
								echo '</script>';
								exit;
							} 
						}
						else
						{
							echo '<script>';
							echo 'swal("Error!", "Ukuran file tidak boleh lebih dari 5MB", "error").then(() => {
								window.location.href = "index.html";
							});';
						echo '</script>';
						exit;
					}
				}
				else
				{
					echo '<script>';
					echo 'swal("Error!", "Gambar tidak boleh kosong", "error").then(() => {
						window.location.href = "index.html";
					});';
				echo '</script>';
				exit;
			}
		}
	?>

	<!-- Konten html -->
	<h6 class="font-weight-normal mt-1">Harap Pilih Template Twibbon</h6>
	<select class="form-control" id="twibbonSelect">
		<option selected>--- Pilih Twibbon ---</option>
		<option value="twibbon1">Rekayasa Perangkat Lunak</option>
		<option value="twibbon2">Sastra Inggris</option>
		<option value="twibbon3">Akuntansi</option>
		<option value="twibbon4">Teknik Industri</option>
		<option value="twibbon5">Manajemen</option>
	</select>
	<a id="download" class="btn btn-outline-primary btn-sm mt-3">Download gambar</a>
	<a href="index.html" id="reset" class="btn btn-outline-danger btn-sm mt-3">Reset Gambar</a>
</form>
</div>

<script> 
	$(document).ready(function() {
		var img1 = $('#img1')[0];
		var img2 = $('#img2')[0];
		var canvas = $('#canvas')[0];
		var context = canvas.getContext("2d");
		var width = img2.width;
		var height = img2.height;
		canvas.width = width;
		canvas.height = height;
		var twibbonSelect = $('#twibbonSelect');
		var selectedTwibbonImg;

				// Event saat dropdown template twibbon berubah
		twibbonSelect.on('change', function() {
			var selectedTwibbon = twibbonSelect.val();
			selectedTwibbonImg = $('#' + selectedTwibbon)[0];
			drawImages();
		});

				// gambar awal tanpa twibbon
		img1.src = img1.getAttribute('src');
		img1.onload = function() {
			selectedTwibbonImg = img1;
			drawImages();
		};

				// Function draw images ke canvas
		function drawImages() {
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.drawImage(img1, 0, 0, width, height);
			if (selectedTwibbonImg) {
				context.drawImage(selectedTwibbonImg, 0, 0, width, height);
			}
		}
	});

			// Function download hasil canvas
	function downloadCanvas(link, canvasId, filename) {
		link.href = document.getElementById(canvasId).toDataURL();
		link.download = filename;
	}

			// Event saat "Download gambar" button di klik
	$('#download').click(function() {
		downloadCanvas(this, 'canvas', 'bsitwibbon.png');
	});

</script>	

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
