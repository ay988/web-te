<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['email'] = $_POST['email'];
    header("Location: formPinjam.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    

        <form action="login2.php" method="POST">
            <div class="box-input">
                <i class="fas fa-envelope-open-text"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn input">LOGIN</button>
            <div class="bottom">
                <p>Belum punya akun? 
                    <a href="registrasi.html">Register di sini</a>
                </p>
            </div>
        </form>
    
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #fce4ec;  
    color: #333;  
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;  
}

form {
    width: 100%;
    max-width: 400px;  
    background-color: #ffffff;  
    padding: 20px;
    border-radius: 10px;  
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    text-align: center;
}

h2 {
    color: #ec407a; 
    margin-bottom: 20px; 
}

label {
    font-size: 16px;
    color: #ec407a;  
    display: block;  
    margin-bottom: 10px;  
}

input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;  
    border: 1px solid #ec407a;  
    border-radius: 5px;  
    box-sizing: border-box;  
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ec407a;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    background-color: #ec407a;  
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;  
    cursor: pointer;
    width: 100%;
    font-size: 16px; 
}

button:hover {
    background-color: #d81b60;  
}

input:focus, button:focus {
    outline: none;
    border: 1px solid #d81b60;  
}


    </style>
</body>
</html>