<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSI Twibbon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./twib.js"></script>
    <style>
        body {
        background-image: url('https://gcdnb.pbrd.co/images/qMyTjzHQiQmB.jpg');
        background-size: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="./assets/nav.png">
                <img src="./assets/nav.png" width="35" height="35">
                <span class="navbar-brand h1">BSI Twibbon Maker</span>
            </a>
        </div>
    </nav>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-5 offset-lg-3 col-md-12 mb-4">
                <div class="card card-body shadow-sm mb-4">
    <?php
    if (isset($_POST['submit']))
    {
        $namafile       = $_FILES["file"]["name"];
        $filegambar     = substr($namafile, 0, strripos($namafile, '.'));
        $ekstensifile   = substr($namafile, strripos($namafile, '.'));
        $ukuranfile     = $_FILES["file"]["size"];
        $jenisfile      = array('.jpg','.jpeg','.png','.JPG','.JPEG','.PNG');

        if (!empty($filegambar))
        {
            if ($ukuranfile <= 5000000)
            {
                if (in_array($ekstensifile, $jenisfile) && ($ukuranfile <= 5000000))
                {
                    $namabaru = time().'_'.uniqid().'_'.date("Ymdhis").'_n'.$ekstensifile;
                    if (file_exists("images/" . $namabaru))
                    {
                        echo '<script>alert("Error!, Terjadi kesalahan, silahkan coba lagi") </script>';
                    }
                    else
                    {       
                        move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $namabaru);
                        $gambar = "images/" . $namabaru;

                        echo '<img src="'.$gambar.'" id="img1" width="500px" height="500px" hidden="true" class="img-fluid">';
                        echo '<img src="twibbon.png" id="img2" width="500px" height="500px" hidden="true" class="img-fluid">';
                        echo '<h2><canvas id="canvas" class="img-fluid"></canvas></h2>';
                        echo '<a id="download" class="btn btn-outline-primary mb-3">Download gambar</a>';
                    }
                }
                else
                {
                    echo '<script>alert("Error!, File yang diupload harus gambar");</script>';
                    unlink($_FILES["file"]["tmp_name"]);
                } 
            }
            else
            {
                echo '<script>alert("Error!, Ukuran file tidak boleh lebih dari 5MB")</script>';
            }
        }
        else
        {
           echo '<script>alert("Gambar Tidak Boleh Kosong")</script>';
        }
    }
    ?>
    <div class="mb-4 fw-light">
        <h5>Bsi Twibbon Maker</h5>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptatibus, ullam aspernatur exercitationem aliquam temporibus fugit. Voluptate, possimus ratione. Voluptas voluptates dignissimos aut modi suscipit aspernatur commodi rem sed voluptatum!</p>
    </div>
    <form enctype="multipart/form-data" method="post">
        <label class="fw-light"><b>Upload foto</b></label>
        <input type="file" name="file" id="image" accept="image/*" class="p-1 img-thumbnail btn-block">
        <div class="mb-2 fst-italic">
            <small>Tips: gunakan ukuran foto 1:1 untuk hasil terbaik</small>
        </div>
        <button type="submit" name="submit" class="btn btn-outline-primary btn-sm">
		    Buat Twibbon!
		</button>
    </form>
</body>
</html>