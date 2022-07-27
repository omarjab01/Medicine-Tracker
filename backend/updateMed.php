<?php
    
    include './config/config.php';

    $nomeMedicina = $_POST['nomeMedicina'];
    $dosaggio = $_POST['dosaggioMedicina'];
    $frequenza = $_POST['frequenza'];
    $idMedicina = $_POST['id-medicina'];


    $queryUpdate = "UPDATE `medicine` SET `nomeMedicina` = '$nomeMedicina', `dosaggio` = '$dosaggio', `frequenza` = '$frequenza' WHERE `medicine`.`ID_Medicina` = '$idMedicina'";

    $result = mysqli_query($conn, $queryUpdate);

    if($result){
                        // echo "Aggiornato!";
                        // session_start();
        header('Location: ../index.php');
    }else{
        echo "Errore :(";
    }
    
    $conn->close();
                

?>