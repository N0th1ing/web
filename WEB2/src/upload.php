<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $uploadDir = "uploads/";
    
    if(!is_dir($uploadDir))
    {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES["file"]["name"]);
    $filePath = $uploadDir . $fileName;
    $fileSize = $_FILES["file"]["size"];
    $fileType = $_FILES["file"]["type"];

    $allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];

    if($_FILES["file"]["error"] !== 0)
    {
        $error = "Eroare la upload";
    } 
    elseif(!in_array($fileType, $allowedTypes))
    {
        $error = "Doar imagini sunt permise";
    } 
    elseif($fileSize > 2 * 1024 * 1024)
    {
        $error = "Fisierul este prea mare (max 2MB)";
    } 
    else 
    {
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $filePath))
        {
            $username = $_SESSION['user'];
            
                include "clase.php";
                $imagine = new Imagine($con);
                $imagine->insert($_SESSION['user'], $fileName);
            
            $success = "Imagine incarcata";
        } 
        else 
        {
            $error = "Nu s-a putut salva fisierul";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow p-4">
        <h1>Incarcare imagine</h1>

        <?php if(isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" name="file" class="form-control" required>
                <small class="text-muted">Doar imagini, max 2MB</small>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="main.php" class="btn btn-secondary ms-2">Înapoi</a>
        </form>

    </div>
</div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
