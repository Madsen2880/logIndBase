<?php
//Her startes session
session_start();
// forbinder til databasen
require 'conn.php';
// her tjekker vi om brugeren er logget ind og hvis brugeren er logget ind henter vi brugerens detaljer.
if (isset($_SESSION['user_id'])){
    $records = $conn->prepare('SELECT id,brugernavn,password FROM brugere WHERE id = :id ');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;
    //hvis vores sql statment for et resultat vil den være mere end 0 og vil outputte brugeren info med $user
    //hvis ikke vil der ikke blive vist noget.
    if (count($results) > 0){
        $user = $results;
    }

}

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
    <title>Log ind base</title>
</head>
<body>
    <div class="header"><a href="index.php">Min Log ind side</a>
    </div>

    <?php if (!empty($user) ): ?>
<!--    her kalder vi at hvis brugeren findes, så vis brugerens navn her-->
        <br>Velkommen <?=$user['brugernavn']; ?>
        <br><br> Du er nu logget ind på siden!
        <br><br>
        <a href="logud.php">Log ud?</a>

    <?php else: ?>
        <h1>Forside for min Log Ind</h1>
        <a href="login.php">Log ind</a> eller
        <a href="opret.php">Opret ny Bruger</a>
    <?php endif ?>
</body>
</html>
