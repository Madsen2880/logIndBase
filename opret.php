<?php
//starter en session
session_start();
// herunder tjekker vi om brugeren er logget ind, hvis det er tilfældet sendes de til forside
if (isset($_SESSION['user_id'])){
    header("Location: index.php");
}

// først kalder jeg min pdo forbindelse der hedder conn.php
require 'conn.php';
$message = '';

//først tjekker vi om der er indhold i vores input felter.

if (!empty($_POST['brugernavn']) && !empty($_POST['password'])):

    //her angiver jeg hvad der skal ske med min data med en sql statement
    $sql = "INSERT INTO brugere (brugernavn,password) VALUES (:brugernavn, :password)";
    $stmt = $conn->prepare($sql);
    // her laver jeg mine prepared statements for at sikre mod sql injecktions
    $stmt->bindParam(':brugernavn', $_POST['brugernavn']);
    $stmt->bindParam(':password', password_hash($_POST['password'],PASSWORD_BCRYPT));
    //her efter køre vi vores statement, og lave if der ender scriptet hvis der går igennem eller ej
    if ($stmt->execute()) {
        $message = 'Du har nu oprettet en ny bruger';
    }else {
        $message = 'Der skete en fejl da vi skulle oprette din bruger';
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
    <title>Opret ny bruger her under</title>
</head>
<body>

    <div class="header"><a href="index.php">Min Log ind side</a>
    </div>

    <?php if (!empty($message)):?>
    <p><?=$message ?></p>
    <?php endif; ?>

    <h1>Opret ny bruger</h1>
    <span>eller <a href="login.php">Log ind her..</a></span>

    <form action="opret.php" method="post">
        <input type="text" placeholder="Skriv dit brugernavn..." name="brugernavn">
        <input type="password" placeholder="Skriv din kode" name="password">
        <input type="password" placeholder="Gentag kode" name="confirm_password">

        <input type="submit" value="Opret bruger">
    </form>


</body>
</html>
