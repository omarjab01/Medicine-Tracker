

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css?v=<?php echo time(); ?>">
</head>
<body>


    <div class="container-sm">
        <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = "medicineTracker";


            $conn = new mysqli($servername, $username, $password, $dbName);


            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }


            $idMedicina = $_GET['id'];
            // echo $idUtenteLoggatoOra;
            $queryEditmedicina = "SELECT * FROM medicine WHERE ID_Medicina = '$idMedicina' LIMIT 1";

            $result = $conn->query($queryEditmedicina);

            while($row = $result->fetch_assoc()){
                ?>
                <form method="POST" action="./backend/updateMed.php" class="form-edit">
                    <h2 class="mb-4">Update</h2>
                    <div class="registrazione">
                    <div class="medicine-input d-flex flex-column mb-3">
                        <label for="nome">Medicine Name</label>
                        <input type="text" name="nomeMedicina" id="" value="<?php echo $row['nomeMedicina'] ?>">
                    </div>
                    <div class="dosage-input d-flex flex-column mb-3">
                        <label for="cognome">Dosage</label>
                        <input type="number" name="dosaggioMedicina" id="" value="<?php echo $row['dosaggio'] ?>">
                    </div>
                    <div class="frequenza-input d-flex flex-column mb-3">
                        <label for="password">Weekly Frequence</label>
                        <input type="number" name="frequenza" id="" value="<?php echo $row['frequenza'] ?>">
                    </div>
                    <input type="hidden" name="id-medicina" value="<?php echo $idMedicina ?>">
                    <div class="cta d-flex justify-content-center">
                        <button class="btn btn-primary mx-auto" type="submit">Save Changes</button>
                        <!-- <button class="btn btn-info">Discard Changes</button> -->
                    </div>
                    
                </form>
                <?php
            }
            ?>


        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
