<?php
//her starter jeg en session for brugeren
session_start();

// herunder tjekker vi om brugeren er logget ind, hvis det er tilfældet sendes de til forside
if (isset($_SESSION['user_id'])){
    header("Location: index.php");
}
// så kalder jeg min pdo forbindelse der hedder conn.php
require 'conn.php';

//først tjekker vi om der er indhold i vores input felter.
if (!empty($_POST['brugernavn']) && !empty($_POST['password'])):

    $records = $conn->prepare('SELECT id,brugernavn,password FROM brugere WHERE brugernavn = :brugernavn ');
    $records->bindParam(':brugernavn', $_POST['brugernavn']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])){
       $_SESSION['user_id'] = $results['id'];
       header("Location: index.php");
    }else{
        $message = 'Bruger navn og adgangskode passer ikke, vi kunne ikke logge dig ind';
    }
endif;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <title>Log Ind her under</title>
</head>
<body>
    <div class="header"><a href="index.php">Min Log ind side</a>
    </div>
    <?php if (!empty($message)):?>
        <p><?=$message ?></p>
    <?php endif; ?>

    <h1>Log Ind</h1>
    <span>eller <a href="opret.php">Opret ny bruger her.</a></span>
    <form action="login.php" method="post">
        <input type="text" placeholder="Skriv dit brugernavn..." name="brugernavn">
        <input type="password" placeholder="Skriv din kode" name="password">

        <input type="submit" value="Log Ind">
    </form>

</body>
</html>
