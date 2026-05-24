<?php
include "connect.php";

if(isset($_POST["submit"]))
{
    $user = $_POST["username"];
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, password) VALUES ('$user', '$pass')";
    $query = mysqli_query($con, $sql) or die(mysqli_error($con));

    echo "<div class='alert alert-success'>User adaugat cu succes!</div>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5" style="max-width: 400px;">
    <div class="card p-4 shadow">
        <h1 class="mb-4">Creare cont</h1>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success w-100">Creează cont</button>
        </form>

        <div class="mt-3 text-center">
            <a href="index.php">Inapoi la login</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>