<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<title>BSI Twibbon</title>
	<meta name="description" content="Bina Sarana Indormatika twibbon Maker">
	<meta name="keyword" content="BSI, BSI Twibbon Maker, twibbon Maker">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Courgette&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
<img src="twibbon1.png" id="twibbon1" width="1000px" height="1000px" hidden="true" class="img-fluid">
<img src="twibbon2.png" id="twibbon2" width="1000px" height="1000px" hidden="true" class="img-fluid">
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
			<div class="col-lg-6 offset-lg-3 col-md-12 mb-4">
				<div class="card card-body shadow-sm mb-4">
					<?php
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
										echo 'swal("Error!", "Terjadi kesalahan, silahkan coba lagi", "error");';
										echo '</script>';
									}
									else
									{       
										move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $namabaru);
										$gambar = "images/" . $namabaru;

										echo '<img src="'.$gambar.'" id="img1" width="1000px" height="1000px" hidden="true" class="img-fluid">';
										echo '<img src="" id="img2" width="1000px" height="1000px" hidden="true" class="img-fluid">';
										echo '<h2><canvas id="canvas" class="img-fluid"></canvas></h2>';
										echo '<a id="download" class="btn btn-outline-primary mb-3">Download gambar</a>';
									}
								}
								else
								{
									echo '<script>';
									echo 'swal("Error!", "File yang diupload harus gambar", "error");';
									echo '</script>';
									unlink($_FILES["file"]["tmp_name"]);
								} 
							}
							else
							{
								echo '<script>';
								echo 'swal("Error!", "Ukuran file tidak boleh lebih dari 5MB", "error");';
								echo '</script>';
							}
						}
						else
						{
							echo '<script>';
							echo 'swal("Error!", "Gambar tidak boleh kosong", "error");';
							echo '</script>';
						}
					}
					
					?>
					<div class="mb-4 font-weight-light">
						<h4 class="font-weight-light">BSI Twibbon Maker</h4>
						<p class="text-start">Aplikasi web yang memungkinkan mahasiswa untuk membuat twibbon khusus dengan mudah. Dengan menggunakan aplikasi ini, mahasiswa dapat mengunggah foto mereka sendiri dan memilih desain twibbon yang telah disediakan. Aplikasi ini menawarkan beberapa desain yang dapat dipilih oleh mahasiswa.</p>
					</div>
					<form method="post" enctype="multipart/form-data">
						<label class="font-weight-light"><b>Upload foto</b></label>
						<input type="file" name="file" id="image" accept="image/*" class="p-1 img-thumbnail btn-block">
						<div class="mb-2 font-italic">
							<small>Harap gunakan ukuran foto 1:1 untuk hasil terbaik</small>
						</div>
						<h6 class="font-weight-light mt-1">Harap Pilih Template Twibbon</h6>
						<select class="form-control" id="twibbonSelect">
						<option selected>--- Pilih Twibbon ---</option>
  						<option value="twibbon1">Software engineer 1</option>
 						<option value="twibbon2">Software engineer 2</option>
						</select>
						<div class="g-recaptcha mt-3" data-sitekey="6Lcd3XwmAAAAANtJKuKoNbniPt-GC8wKKn7cWIV6"></div>
						<button type="submit" id="submit" name="submit" class="btn btn-primary btn-sm mt-3">
							Buat Twibbon!
						</button>
						<a title="Cara penggunaan" class="btn btn-info btn-sm mt-3" data-toggle="modal" data-target="#modal">
							Cara penggunaan
							
						</a>
					</form>
				</div>
				<div class="card card-body shadow-sm">
					<div class="font-weight-light">
					Made with <span style="color: #e25555;">&#9829;</span> By kelompok 5 RPL
					<p>Klik <a href="#" data-toggle="modal" data-target="#teamModal">Disini</a> untuk melihat tim pengembang.</p>
    			</div>

				<div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="teamModalLabel">Developers BSI Twibbon Maker</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <div class="card">
                            <img src="./assets/azfa.jpg" alt="Azfa" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Azfa Haqqani</h4>
                                <p class="card-text">Jungler</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="card">
                            <img src="./assets/irvan.jpg" alt="Irvan" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Irvan Pram</h4>
                                <p class="card-text">Mid laner</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="card">
                            <img src="./assets/iki.jpg" alt="Iki" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Rizky Fernand</h4>
                                <p class="card-text">Exp laner</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <div class="card">
                            <img src="./assets/haikal.jpg" alt="Haikal" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Haikal Putra</h4>
                                <p class="card-text">Gold laner</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="card">
                            <img src="./assets/tirtha.jpg" alt="Tirtha" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Tirtha Raga</h4>
                                <p class="card-text">Roamer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	
	<div class="modal modal-fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<b>Cara penggunaan</b>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					1. Pilih gambar yang akan digunakan untuk Twibbon Anda dengan mengklik tombol "Upload foto".
         			<br>
					2. Verifikasi captcha, untuk memastikan bahwa anda bukan robot.
					<br>
                  	3. Klik tombol "Buat Twibbon!" untuk menghasilkan Twibbon Anda.
                  	<br>
          			4. Pilih salah satu desain Twibbon yang tersedia pada dropdown menu "Harap Pilih Template Twibbon".
         		 	<br>
          			5. Setelah berhasil, Anda dapat mengunduh Twibbon tersebut dengan mengklik tombol "Download gambar".
					<p> </p>
				</div>
			</div>
		</div>
	</div>
	
<script> 
$(document).on('click', '#submit', function() {
	var response = grecaptcha.getResponse();
	if (response.length == 0) {
		alert("Silahkan verifikasi bahwa kamu bukanlah ROBOT:)")
		return false;
	} else {
		console.log("reCAPTCHA verification passed!");
	}
});
window.onload = function() {
	var img1 = document.getElementById('img1');
	var img2 = document.getElementById('img2');
	var canvas = document.getElementById("canvas");
	var context = canvas.getContext("2d");
	var width = img2.width;
	var height = img2.height;
	canvas.width = width;
	canvas.height = height;
	var twibbonSelect = document.getElementById('twibbonSelect');
	twibbonSelect.addEventListener('change', function() {
		var selectedTwibbon = twibbonSelect.value;
		var selectedTwibbonImg = document.getElementById(selectedTwibbon);
		context.clearRect(0, 0, canvas.width, canvas.height);
		context.drawImage(img1, 0, 0, width, height);
		context.drawImage(selectedTwibbonImg, 0, 0, width, height);
	});
	// Gambar awal
	context.clearRect(0, 0, canvas.width, canvas.height);
	context.drawImage(img1, 0, 0, width, height);
	context.clearRect(0, 0, canvas.width, canvas.height);
	context.drawImage(img1, 0, 0, width, height);
	context.drawImage(selectedTwibbonImg, 0, 0, width, height);
};

function downloadCanvas(link, canvasId, filename) {
	link.href = document.getElementById(canvasId).toDataURL();
	link.download = filename;
}
document.getElementById('download').addEventListener('click', function() {
	downloadCanvas(this, 'canvas', 'bsitwibbon.png');
}, false); 
</script>	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
