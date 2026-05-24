<?php 
session_start();

if(isset($_COOKIE['user_login']))
{
    $_SESSION['user'] = $_COOKIE['user_login'];
    header("Location: main.php");
    exit;
}

if(!isset($_SESSION['captcha']))
{
    $_SESSION['captcha'] = rand(10, 99);
}

if(isset($_SESSION['error']))
{
    echo "<p style='color:red;'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}

if(!isset($_SESSION['captcha']))
{
    $_SESSION['captcha'] = rand(10, 99);
}

if(isset($_SESSION['error']))
{
    echo "<p style='color:red;'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Proiect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">

<div class="card p-4 shadow" style="width: 400px;">
    <h1 class="mb-4 text-center">Autentificare</h1>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label class="form-label">Username:</label><input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password:</label><input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input"><label class="form-check-label">Remember me</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Captcha: <strong><?php echo $_SESSION['captcha']; ?></strong></label><input type="text" name="captcha" class="form-control" required>
        </div>

        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="mt-3 text-center"><a href="register.php">Creare cont nou</a></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelector("form").addEventListener("submit", function(e)
        {
            let username = document.querySelector("input[name='username']").value.trim();
            let password = document.querySelector("input[name='password']").value.trim();
            let captcha = document.querySelector("input[name='captcha']").value.trim();

            if(username === "")
            {
                alert("Username-ul nu poate fi gol");
                e.preventDefault();
                return;
            }

            if(password.length < 3)
            {
                alert("Parola trebuie să aiba minim 3 caractere");
                e.preventDefault();
                return;
            }

            if(captcha === "")
            {
                alert("Introduceti codul captcha");
                e.preventDefault();
                return;
            }
        });
    </script>

</body>
</html>