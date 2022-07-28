<?php


    include './config/config.php';

    $idMedicina = $_POST['id-med'];

    // $idMedicina = 25;

    $queryDelete = "DELETE FROM `medicine` WHERE ID_Medicina = '$idMedicina'";

    // echo $idMedicina;

    $result = mysqli_query($conn, $queryDelete);

    if($result){
        // echo "ok";
        header('Location: ../index.php');
    }else{
        echo "Errore :(";
    }

    $conn->close();



?>