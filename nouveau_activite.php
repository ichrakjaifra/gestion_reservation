<?php 
include_once('db.php');
$title="Ajouter";
$titre="";
$description="";
$destination="";
$prix="";
$date_debut="";
$date_fin="";
$places_disponibles="";
$btn_title="Ajouter";
if(isset($_GET['action']) && $_GET['action']=='edit'){
    
    $id_activite=$_GET['id_activite'];
    $sql="SELECT * FROM activite WHERE id_activite = ".$id_activite;
    $activite =mysqli_query($con,$sql);
    if($activite){
       $title="Modifier" ;
       $current_activite=$activite->fetch_assoc();
       $titre=$current_activite['titre'];
       $description=$current_activite['description'];
       $destination=$current_activite['destination'];
       $prix=$current_activite['prix'];
       $date_debut=$current_activite['date_debut'];
       $date_fin=$current_activite['date_fin'];
       $places_disponibles=$current_activite['places_disponibles'];
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
  <title>Ajouter une Activité</title>
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

<!-- <div class="container" style="margin-top: 70px; margin-bottom: 20px;">
  <div class="text-right">
    <a href="activites.php" class="btn btn-warning btn-lg">
      <i class="glyphicon glyphicon-arrow-left"></i> Retour aux activités
    </a>
  </div>    
</div> -->

<div class="container" style="margin-top: 80px;">
  <div class="panel panel-primary">
    <div class="panel-heading"><?php echo $title; ?> une nouvelle activité</div>
    <div class="panel-body">
      <form method="POST" action="activites.php">

        <div class="form-group">
          <label for="titre">Titre de l'activité</label>
          <input type="text" class="form-control"  name="titre" value="<?php echo $titre; ?>" autocomplete="false">
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" name="description" value="<?php echo $description; ?>" rows="4" autocomplete="false"></textarea>
        </div>

        <div class="form-group">
          <label for="destination">Destination</label>
          <input type="text" class="form-control" name="destination" value="<?php echo $destination; ?>" autocomplete="false">
        </div>

        <div class="form-group">
          <label for="prix">Prix</label>
          <input type="number" class="form-control" name="prix" value="<?php echo $prix; ?>" step="0.01" autocomplete="false">
        </div>

        <div class="form-group">
          <label for="date_debut">Date de début</label>
          <input type="date" class="form-control" name="date_debut" value="<?php echo $date_debut; ?>" autocomplete="false">
        </div>

        <div class="form-group">
          <label for="date_fin">Date de fin</label>
          <input type="date" class="form-control" name="date_fin" value="<?php echo $date_fin; ?>" autocomplete="false">
        </div>

        <div class="form-group">
          <label for="places_disponibles">Places disponibles</label>
          <input type="number" class="form-control"  name="places_disponibles" value="<?php echo $places_disponibles; ?>" autocomplete="false">
        </div>

        <!-- <button type="submit" name="Ajouter" class="btn btn-success">Ajouter</button> -->


        <?php

        if (isset($_GET['id_activite'])){?>

           <input type="hidden" name="id_activite" value="<?php echo $_GET['id_activite'] ?>">

       <?php   }  
       
       ?>

        <input type="submit" class="btn btn-primary" value="<?php echo $btn_title; ?>" name="Ajouter">
        <a href="activites.php" class="btn btn-default">Retour</a>
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
