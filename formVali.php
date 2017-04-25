<?php

if (isset($_POST['btn'])){
    //tager input
    $user = $_POST['brugernavn'];
    $pass = $_POST['password'];
    $confpass = $_POST['confirm_password'];

    //input validering

    if (empty($user)){
        $uerr="brugnavn må ikke være tomt";
    }elseif (!preg_match("/^[a-åA-Å]*$/", $user)){
        $uerr="brugernavn må kun indeholde store og små bogstaver";
    }
    if (empty($pass)){
        $perr="password skal udfyldes";
    }
    if (empty($confpass)){
        $cperr="du skal gentag dit password";
    }
    if ($pass!=$confpass){
        $perr="password matcher ikke";
    }



}