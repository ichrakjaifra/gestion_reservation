<?php
include_once('db.php');
$action = false;
if (isset($_POST['Ajouter'])) {

  $titre = $_POST['titre'];
  $description = $_POST['description'];
  $destination = $_POST['destination'];
  $prix = $_POST['prix'];
  $date_debut = $_POST['date_debut'];
  $date_fin = $_POST['date_fin'];
  $places_disponibles = $_POST['places_disponibles'];
  if ($_POST['Ajouter'] == "Ajouter") {
    $save_sql = "INSERT INTO `activite`( `titre`, `description`, `destination`, `prix`, `date_debut`, `date_fin`,`places_disponibles`) VALUES 
          ('$titre','$description','$destination','$prix','$date_debut','$date_fin','$places_disponibles')";
  }else{
    $id_activite= $_POST['id_activite'] ;
    $save_sql = "UPDATE `activite` SET `titre`='$titre',`description`='$description' ,`destination`='$destination' ,
    `prix`='$prix',`date_debut`='$date_debut',`date_fin`='$date_fin', `places_disponibles`='$places_disponibles' WHERE id_activite =$id_activite " ;
    }
  

  $res_save = mysqli_query($con, $save_sql);
  if (!$res_save) {
    die(mysqli_error($con));

  } else {
    if (isset($_POST['id_activite'])){
      $action = "edit";
    }else{
      $action = "add";
    }

  }

}
if (isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id_activite'])) {
  $id_activite = $_GET['id_activite'];
  $del_sql = "DELETE FROM activite WHERE id_activite = $id_activite";
  $res_del = mysqli_query($con, $del_sql);
  if (!$res_del) {
    die(mysqli_error($con));

  } else {
    $action = "del";
  }
}
$activites_sql = "SELECT * FROM activite";
$all_activite = mysqli_query($con, $activites_sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/toster.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <title>Document</title>
  <!-- <link rel="stylesheet" href="css/monStyle.css"> -->
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

<div class="container" style="margin-top: 70px; margin-bottom: 20px;">
<div class="text-right">
    <a href="nouveau_activite.php" class="btn btn-success btn-lg">
      <i class="glyphicon glyphicon-plus"></i> Nouvelle activité
    </a>
</div>    
  </div>
  
<div class="container">
  <div class="panel panel-primary">
  <div class="panel-heading">Liste des activités</div>
  <div class="panel-body">
    
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id activite</th><th>Titre</th><th>Description</th><th>Destination</th><th>Prix</th><th>Date debut</th><th>Date fin</th><th>Places disponibles</th><th>Actions</th>
        </tr>
      </thead>

      <tbody>
      <?php

while ($activite = $all_activite->fetch_assoc()) { ?>
  

  <tr>

    <td>
    <?php echo $activite['id_activite']; ?>  
    </td>
    <td>
    <?php echo $activite['titre']; ?>  
    </td>
    <td>
    <?php echo $activite['description']; ?>
    </td>
    <td>
    <?php echo $activite['destination']; ?>
    </td>
    <td>
    <?php echo $activite['prix']; ?>
    </td>
    <td>
    <?php echo $activite['date_debut']; ?>
    </td>
    <td>
    <?php echo $activite['date_fin']; ?>
    </td>
    <td>
    <?php echo $activite['places_disponibles']; ?>
    </td>

    <td>
      <!-- <div class="d-flex p-2 justify-content-evenly mb-2">

        <i onclick="confirm_delete();" class="text-danger" data-feather="trash-2"></i>
        <i onclick="edit();" class="text-success" data-feather="edit"></i>
      </div> -->
      <span class="glyphicon glyphicon-edit" onclick="edit_activite(<?php echo $activite['id_activite']; ?>);"></span>
      &nbsp;
      <span class="glyphicon glyphicon-trash" onclick="confirm_delete_activite(<?php echo $activite['id_activite']; ?>);"></span>
    </td>
  </tr>
  <?php }

?>

      </tbody>
    </table>
  </div>  
  </div>
</div>
<!-- <nav class="bg-gray-800 fixed top-0 w-full">
  <div class="container mx-auto px-4 py-2 flex justify-between items-center">
    <div class="text-white text-lg font-bold">
      <a href="" class="hover:text-gray-300">Gestion des Réservations</a>
    </div>  
    <ul class="flex space-x-4">
      <li><a href="index.php" class="text-white hover:text-gray-300">Les clients</a></li>
      <li><a href="activites.php" class="text-white hover:text-gray-300">Les activités</a></li>
      <li><a href="reservations.php" class="text-white hover:text-gray-300">Les réservations</a></li>
    </ul>
  </div>
</nav> -->

<!-- Footer Section -->
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <p>&copy; 2024 Gestion des Réservations. All rights reserved.</p>
      </div>
      <div class="col-sm-6 text-right">
        <p>Designed by <a href="https://www.yourwebsite.com" target="_blank">Ichrak Jaifra</a></p>
      </div>
    </div>
  </div>
</footer>

<!-- Add some CSS styles for the footer -->
<style>
  .footer {
    background-color: #f8f8f8;
    padding: 20px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
    text-align: center;
    border-top: 1px solid #ddd;
  }
  .footer a {
    text-decoration: none;
    color: #5bc0de;
  }
  .footer a:hover {
    color: #0275d8;
  }
</style>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="js/toster.js"></script>
<script src="js/main.js"></script>
<?php
  if ($action != false) {
    if ($action == 'add') { ?>
      <script>
        show_add()
      </script>


      <?php
    }
    if ($action == 'del') { ?>
      <script>
        show_del()
      </script>


      <?php
    }
    if ($action == 'edit') { ?>
      <script>
        show_update()
      </script>


      <?php
    }
  }
  ?>
  <script>
    feather.replace();
  </script>
</body>
</html>