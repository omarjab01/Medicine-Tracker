<?php

include './config/config.php';

$name = $_POST['nome'];
$surname = $_POST['cognome'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO utenti (nome, cognome, email, password) VALUES ('$name', '$surname', '$email', '$hashedPassword')";
if($conn->query($query) === true){
    echo "Registrazione avvenuta con successo! :)";
    session_start();
    header('Location: ../index.php');
}else{
    echo "Errore :(";
}

?>