<?php

//starter en session
session_start();
// frigører alle session variabler
session_unset();
//lukker alle aktive sessions
session_destroy();
//Sender brugeren tilbage til forside
header("Location: index.php");



