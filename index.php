<?php

    session_start();
    if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
        header("Location: login.html");
        exit;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Tracker</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container-sm">
        <div class="navbar my-2">
            <div class="utente-loggato">
                <h3>Hello, <?php echo $_SESSION['nome'] ?>👋 </h3>
            </div>
            <div class="right-nav d-flex align-items-center">
                <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupInput">New Medicine</button> -->
                <img src="https://www.capsuleco.it/img/postestimonial/385-user(1).png" alt="" class="ms-5" height="50px" >
            </div>
            
        </div>
        <div class="title d-flex flex-row justify-content-between mt-5 align-items-center">
            <h5>Your Medicines</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupInput">Add medicine</button>
        </div>
        <hr>


        <div class="medicine">
            <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbName = "medicineTracker";


                $conn = new mysqli($servername, $username, $password, $dbName);


                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }


                $idUtenteLoggatoOra = $_SESSION['id'];
                // echo $idUtenteLoggatoOra;
                $queryShowMedicine = "SELECT * FROM medicine WHERE ID_UTENTE = '$idUtenteLoggatoOra'";

                $result = $conn->query($queryShowMedicine);

                while($row = $result->fetch_assoc()){
                    echo "
                        <div class='card mb-4'>
                            <div class='card-header bg-primary bg-gradient'>
                                <h5 class='card-title text-white'>$row[nomeMedicina]</h5>
                            </div>
                            <div class='card-body d-flex flex-row justify-content-between'>
                                <div class='info-medicina d-flex flex-row'>
                                    <div class='dosaggio-card'>
                                        <img src='https://media.istockphoto.com/vectors/cough-syrup-color-icon-common-cold-aid-throat-pain-cure-medication-vector-id1223421493?k=20&m=1223421493&s=612x612&w=0&h=xWykBnLB5WY1rr40dl8oANrOvff1O_BZ0zYpvgylAEE=' height='80px' class='mb-3'>
                                        <h6 class='text-center'>$row[dosaggio] Mg</h6>
                                    </div>
                                    <div class='frequenza-card ms-5'>
                                        <img src='https://www.obsidiansecurity.com/wp-content/uploads/2020/10/cal-icon.png'  height='80px' class='mb-3'>
                                        <h6 class='text-center'>$row[frequenza] Times a Week</h6>
                                    </div>
                                </div>
                                <div class='bottoni-card'>
                                    <a class='btn link' href='update.php?id=$row[ID_Medicina]'>Modifica</a>
                                    <a class='btn btn-danger'>Elimina</a>
                                    
                                </div>
                            </div>
                        </div>
                    ";
                }

            ?>

        </div>



        <!-- Popup Input -->
        <div class="modal" tabindex="-1" id="popupInput">
            <div class="modal-dialog">
                <form class="modal-content" action="./backend/insert.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">New Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="nome-medicina d-flex flex-column mb-2">
                            <label for="nome">Medicine Name</label>
                            <input type="text" name="nome-medicina" placeholder="What's the medicine name?">
                        </div>
                        <div class="dosaggio d-flex flex-column mb-2">
                            <label for="dosaggio">Enter the dosage</label>
                            <input type="number" name="dosaggio" id="" placeholder="Dosage">
                        </div>
                        <div class="frequenza d-flex flex-column">
                            <label for="frequenza">How many times a week do you have to take it?</label>
                            <input type="number" name="frequenza" id="" placeholder="Frequency">
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id-utente">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="edit-modal">
            <div class="modal-dialog">
                <form class="modal-content" action="./backend/insert.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="nome-medicina d-flex flex-column mb-2">
                            <label for="nome">Medicine Name</label>
                            <input type="text" name="nome-medicina" placeholder="What's the medicine name?">
                        </div>
                        <div class="dosaggio d-flex flex-column mb-2">
                            <label for="dosaggio">Dosage</label>
                            <input type="number" name="dosaggio" id="" placeholder="Dosage">
                        </div>
                        <div class="frequenza d-flex flex-column">
                            <label for="frequenza">Weekly Frequency</label>
                            <input type="number" name="frequenza" id="" placeholder="Frequency">
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id-utente">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="script/script.js"></script>
</body>
</html>