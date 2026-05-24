<?php 
session_start();
include "connect.php";

if (!isset($_SESSION['captcha'])) 
{
    $_SESSION['captcha'] = rand(10, 99);
}

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $captcha_input = $_POST['captcha'] ?? '';

    if($captcha_input != $_SESSION['captcha'])
    {
        $_SESSION['error'] = "Captcha incorect";
        $_SESSION['captcha'] = rand(10, 99);
        header("Location: index.php");
        exit;
    } 
    else 
    {
        $username = mysqli_real_escape_string($con, $username);
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($result);

        if($user && password_verify($password, $user['password']))
        {
            $_SESSION['user'] = $username;

            if(isset($_POST['remember']))
            {
                setcookie("user_login", $username, time() + (86400 * 30), "/", "", false, true);
            }

            unset($_SESSION['captcha']);
            header("Location: main.php");
            exit;
        } 
        else 
        {
            $_SESSION['error'] = "Login gresit";
            header("Location: index.php");
            exit;
        }
    }
}
?>