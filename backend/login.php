<?php

include './config/config.php';

$email = $conn->real_escape_string(($_POST['email']));
$password = $conn->real_escape_string(($_POST['password']));

$query = "SELECT * FROM utenti WHERE email LIKE '$email'";

if($result = $conn->query($query)){
    if($result->num_rows == 1){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if(password_verify($pwd, $row["password"])){
            session_start();
            $_SESSION['id'] = $row['ID'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['cognome'] = $row['cognome'];
            $_SESSION['loggato'] = true;

            header("Location: ../index.php");
        }
        else{
            echo "La password non è corretta..";
        }
    }
    else{
        echo "Non ci sono account registrati con quella email";
    }
}else{
    echo "Errore in fase di Login";
}

$conn->close();

?>