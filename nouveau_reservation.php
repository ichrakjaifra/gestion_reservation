<?php
include_once('db.php');
$title="Ajouter";
$id_client="";
$id_activite="";
$date_reservation="";
$statut="";
$btn_title="Ajouter";

if(isset($_GET['action']) && $_GET['action']=='edit'){
    
  $id_reservation=$_GET['id_reservation'];
  // $sql="SELECT * FROM reservation WHERE id_reservation = ".$id_reservation;
  $sql = "SELECT 
            reservation.*, 
            client.nom AS nom_client, 
            activite.nom AS nom_activite 
        FROM reservation
        INNER JOIN client ON reservation.id_client = client.id_client
        INNER JOIN activite ON reservation.id_activite = activite.id_activite
        WHERE reservation.id_reservation = ".$id_reservation;

  $reservation =mysqli_query($con,$sql);
  if($reservation){
     $title="Modifier" ;
     $current_reservation=$reservation->fetch_assoc();
     $id_client=$current_reservation['id_client'];
     $id_activite=$current_reservation['id_activite'];
     $date_reservation=$current_reservation['date_reservation'];
     $statut=$current_reservation['statut'];
     $nom_client = $current_reservation['nom_client']; 
     $nom_activite = $current_reservation['nom_activite']; 
     $btn_title="Modifier";

  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/toster.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <title>Ajouter une Reservation</title>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="" class="navbar-brand"> Gestion des Réservations</a>
    </div>  
    <ul class="nav navbar-nav">
      <li><a href="index.php">Les clients</a></li>
      <li><a href="activites.php">Les activités</a></li>
      <li><a href="reservations.php">Les réservations</a></li>
    </ul>
  </div>
</nav>


<div class="container" style="margin-top: 80px;">
  <div class="panel panel-primary">
    <div class="panel-heading"> une nouvelle reservation</div>
    <div class="panel-body">
      <form method="POST" action="reservations.php">

      <!-- Champ Client -->
      <div class="form-group">
                    <label for="id_client">Client :</label>
                    <select name="id_client" id="id_client" class="form-control" required>
                        <option value="">-- Sélectionnez un client --</option>
                        <?php
                        $sql_clients = "SELECT id_client, nom FROM client";
                        $result_clients = mysqli_query($con, $sql_clients);
                        while ($row = $result_clients->fetch_assoc()) {
                            $selected = ($id_client == $row['id_client']) ? 'selected' : '';
                            echo "<option value='" . $row['id_client'] . "' $selected>" . $row['nom'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Champ Activité -->
                <div class="form-group">
                    <label for="id_activite">Activité :</label>
                    <select name="id_activite" id="id_activite" class="form-control" required>
                        <option value="">-- Sélectionnez une activité --</option>
                        <?php
                        $sql_activites = "SELECT id_activite, titre FROM activite";
                        $result_activites = mysqli_query($con, $sql_activites);
                        while ($row = $result_activites->fetch_assoc()) {
                            $selected = ($id_activite == $row['id_activite']) ? 'selected' : '';
                            echo "<option value='" . $row['id_activite'] . "' $selected>" . $row['titre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Champ Date de Réservation -->
                <div class="form-group">
                    <label for="date_reservation">Date de Réservation :</label>
                    <input type="date" name="date_reservation" id="date_reservation" value="<?php echo $date_reservation; ?>" class="form-control" required>
                </div>

                <!-- Champ Statut -->
                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <select name="statut" id="statut" class="form-control" required>
                        <option value="En attente" <?php echo ($statut == 'En attente') ? 'selected' : ''; ?>>En attente</option>
                        <option value="Confirmée" <?php echo ($statut == 'Confirmée') ? 'selected' : ''; ?>>Confirmée</option>
                        <option value="Annulée" <?php echo ($statut == 'Annulée') ? 'selected' : ''; ?>>Annulée</option>
                    </select>
                </div>


        <?php

        if (isset($_GET['id_reservation'])){?>

           <input type="hidden" name="id_reservation" value="<?php echo $_GET['id_reservation'] ?>">

       <?php   }  
       
       ?>

        <input type="submit" class="btn btn-primary" value="<?php echo $btn_title; ?>" name="Ajouter">
        <a href="reservations.php" class="btn btn-default">Retour</a>
      </form>
    </div>  
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
        feather.replace()
    </script>
</body>
</html>