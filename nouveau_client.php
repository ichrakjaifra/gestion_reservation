<?php 
include_once('db.php');
$title="Ajouter";
$nom="";
$prenom="";
$email="";
$telephone="";
$adresse="";
$date_naissance="";
$btn_title="Ajouter";
if(isset($_GET['action']) && $_GET['action']=='edit'){
    
    $id_client=$_GET['id_client'];
    $sql="SELECT * FROM client WHERE id_client = ".$id_client;
    $user =mysqli_query($con,$sql);
    if($user){
       $title="Modifier" ;
       $current_user=$user->fetch_assoc();
       $nom=$current_user['nom'];
       $prenom=$current_user['prenom'];
       $email=$current_user['email'];
       $telephone=$current_user['telephone'];
       $adresse=$current_user['adresse'];
       $date_naissance=$current_user['date_naissance'];
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
  <title>Ajouter un Client</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarMenu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php" class="navbar-brand">Gestion des Réservations</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarMenu">
    <ul class="nav navbar-nav">
    <li><a href="index.php">Les clients</a></li>
    <li><a href="activites.php">Les activités</a></li>
    <li><a href="reservations.php">Les réservations</a></li>
  </ul>
  </div>
</nav>

<div class="container" style="margin-top: 80px;">
  <div class="panel panel-primary">
    <div class="panel-heading text-center"><?php echo $title; ?> un Nouveau Client</div>
    <div class="panel-body">
      <form action="index.php" method="POST">
      <div class="row">
        <div class="col-md-6">
          <label for="nom">Nom :</label>
          <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>" placeholder="Entrez le nom" autocomplete="false">
        </div>
        <div class="col-md-6">
          <label for="prenom">Prénom :</label>
          <input type="text" class="form-control" name="prenom" value="<?php echo $prenom; ?>" placeholder="Entrez le prénom" autocomplete="false">
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
          <label for="email">Email :</label>
          <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Entrez l'email" autocomplete="false">
        </div>
        <div class="col-md-6">
          <label for="telephone">Téléphone :</label>
          <input type="text" class="form-control" name="telephone" value="<?php echo $telephone; ?>" placeholder="Entrez le numéro de téléphone">
        </div>
        </div>
        <div class="form-group">
          <label for="adresse">Adresse :</label>
          <textarea class="form-control" name="adresse" value="<?php echo $adresse; ?>" rows="3" placeholder="Entrez l'adresse"></textarea>
        </div>
        <div class="form-group">
          <label for="date_naissance">Date de naissance :</label>
          <input type="date" class="form-control" name="date_naissance" value="<?php echo $date_naissance; ?>">
        </div>
        <!-- <button type="submit" class="btn btn-primary">Ajouter</button> -->

        <?php

        if (isset($_GET['id_client'])){?>

           <input type="hidden" name="id_client" value="<?php echo $_GET['id_client'] ?>">

       <?php   }  
       
       ?>

        <input type="submit" class="btn btn-primary" value="<?php echo $btn_title; ?>" name="Ajouter">
        <a href="index.php" class="btn btn-default">Retour</a>
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
