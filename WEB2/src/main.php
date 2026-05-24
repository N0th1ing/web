<?php
session_start();

if(!isset($_SESSION['user']) && isset($_COOKIE['user_login']))
{
    $_SESSION['user'] = $_COOKIE['user_login'];
}

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    exit;
}

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pagina Principala</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4 mb-4">
    <span class="navbar-brand">Proiect</span><span class="text-white">Bună,<strong><?php echo $_SESSION['user']; ?></strong>!</span>
    <div>
        <button class="btn btn-outline-primary btn-sm me-2" onclick="this.innerHTML=' ' + (parseInt(this.getAttribute('data-count') || 0) + 1) + ' Like'; this.setAttribute('data-count', parseInt(this.getAttribute('data-count') || 0) + 1)"> Like</button>
        <a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/site/main.php" target="_blank" class="btn btn-outline-light btn-sm me-2">Share</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="row g-4">
        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">Incarcare fisiere</h1>
                <form action="upload.php" method="POST" enctype="multipart/form-data"><input type="file" name="file" class="form-control mb-2"><button type="submit" class="btn btn-secondary">Upload</button></form>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">Imagini</h1>
                <?php
                    include "clase.php";
                    $imagine = new Imagine($con);
                    $result = $imagine->getAll();
                    
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<img src="uploads/' . $row['nume_fisier'] . '" class="img-thumbnail m-1" width="120">';
                        }
                    } 
                    else 
                    {
                        echo '<p class="text-muted">Nu există imagini încărcate.</p>';
                    }
                ?>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">Harta UAIC</h1><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1917.7812240528262!2d27.571698276944566!3d47.17445734430976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb61af5ef507%3A0x95f1e37c73c23e74!2sAlexandru%20Ioan%20Cuza%20University!5e0!3m2!1sen!2sro!4v1776185888835!5m2!1sen!2sro" 
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">Youtube</h1><iframe width="100%" height="300" src="https://www.youtube.com/embed/-OWLwzOkm2c" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">MP3</h1><audio controls class="w-100"><source src="song.mp3" type="audio/mpeg"></audio>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">MP4</h1><video controls class="w-100"><source src="video.mp4" type="video/mp4"></video>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">Canvas</h1><canvas id="c" width="150" height="80" style="border:1px solid black;"></canvas>
                <script>
                    let c = document.getElementById("c");
                    let ctx = c.getContext("2d");
                    ctx.fillStyle = "green";
                    ctx.fillRect(10,10,100,50);
                </script>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow p-3 h-100">
                <h1 class="card-title">SVG</h1><svg width="150" height="80"><rect width="100" height="50" fill="orange"/></svg>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>