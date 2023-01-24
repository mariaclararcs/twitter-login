<?php
include("database.php");

if(isset($_POST['email']) || isset($_POST['password'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $sqlcode = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
    $sqlquery = $mysqli->query($sqlcode) or die("Falha na conexão do SQL: " . $mysqli);
    $quantidade = $sqlquery->num_rows;
    if($quantidade==1){
        $usuario = $sqlquery->fetch_assoc();

        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION["name"] = $usuario["name"];
        $_SESSION["id"] = $usuario["id"];
        header("Location: sucesso.php");
    }else{
    echo "Falha ao realizar o login";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar no Twitter</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="img/icon.png" type="image/png">
</head>
<body>
    <div id="container-login">
        <img src="img/logo.png" class="logo">
        <div class="login">
            <form method="post" action="#">
                <h3>Entrar no Twitter</h3>
                <input type="submit" name="google" value="Entrar com Google" class="btngoogle">
                <input type="submit" name="apple" value="Entrar com Apple" class="btnapple">
                <hr>
                <input type="email" name="email" placeholder="Digite seu email" class="campoemail">
                <input type="password" name="password" placeholder="Digite sua senha" class="camposenha">
                <input type="submit" name="avancar" value="Avançar" class="btnavancar">
                <input type="submit" name="esqueceu" value="Esqueçeu sua senha?" class="btnesqueceu">
            </form>
        </div>
    </div>
</body>
</html>