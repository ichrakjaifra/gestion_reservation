<?php
include_once('db.php');
$action = false;
if (isset($_POST['Ajouter'])) {

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $adresse = $_POST['adresse'];
  $date_naissance = $_POST['date_naissance'];
  if ($_POST['Ajouter'] == "Ajouter") {
    $save_sql = "INSERT INTO `client`( `nom`, `prenom`, `email`, `telephone`, `adresse`, `date_naissance`) VALUES 
          ('$nom','$prenom','$email','$telephone','$adresse','$date_naissance')";
  }else{
    $id_client= $_POST['id_client'] ;
    $save_sql = "UPDATE `client` SET `nom`='$nom',`prenom`='$prenom' ,`email`='$email' ,
    `telephone`='$telephone',`adresse`='$adresse',`date_naissance`='$date_naissance' WHERE id_client =$id_client " ;
    }
  

  $res_save = mysqli_query($con, $save_sql);
  if (!$res_save) {
    die(mysqli_error($con));

  } else {
    if (isset($_POST['id_client'])){
      $action = "edit";
    }else{
      $action = "add";
    }

  }

}
if (isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id_client'])) {
  $id_client = $_GET['id_client'];
  $del_sql = "DELETE FROM client WHERE id_client = $id_client";
  $res_del = mysqli_query($con, $del_sql);
  if (!$res_del) {
    die(mysqli_error($con));

  } else {
    $action = "del";
  }
}
$users_sql = "SELECT * FROM client";
$all_user = mysqli_query($con, $users_sql);


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
  <title>Gestion des Réservations</title>
  <!-- <link rel="stylesheet" href="css/monStyle.css"> -->
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
      <a href="" class="navbar-brand"> Gestion des Réservations</a>
    </div>  
    <div class="collapse navbar-collapse" id="navbarMenu">
  <ul class="nav navbar-nav">
    <li><a href="index.php">Les clients</a></li>
    <li><a href="activites.php">Les activités</a></li>
    <li><a href="reservations.php">Les réservations</a></li>
  </ul>
  </div>
  </div>
</nav>

<div class="container" style="margin-top: 70px; margin-bottom: 20px;">
<div class="text-right">
    <a href="nouveau_client.php" class="btn btn-success btn-lg">
      <i class="glyphicon glyphicon-plus"></i> Nouvelle client
    </a>
</div>    
  </div>
  
<div class="container">
  <div class="panel panel-primary">
  <div class="panel-heading">Liste des clients</div>
  <div class="panel-body">
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id client</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Telephone</th><th>Adresse</th><th>Date naissance</th><th>Actions</th>
        </tr>
      </thead>

      <tbody>
      <?php

while ($user = $all_user->fetch_assoc()) { ?>
  

  <tr>

    <td>
    <?php echo $user['id_client']; ?>  
    </td>
    <td>
    <?php echo $user['nom']; ?>  
    </td>
    <td>
    <?php echo $user['prenom']; ?>
    </td>
    <td>
    <?php echo $user['email']; ?>
    </td>
    <td>
    <?php echo $user['telephone']; ?>
    </td>
    <td>
    <?php echo $user['adresse']; ?>
    </td>
    <td>
    <?php echo $user['date_naissance']; ?>
    </td>

    <td>
      <!-- <div class="d-flex p-2 justify-content-evenly mb-2">

        <i onclick="confirm_delete();" class="text-danger" data-feather="trash-2"></i>
        <i onclick="edit();" class="text-success" data-feather="edit"></i>
      </div> -->
      <span class="glyphicon glyphicon-edit" onclick="edit_client(<?php echo $user['id_client']; ?>);"></span>
      &nbsp;
      <span class="glyphicon glyphicon-trash" onclick="confirm_delete_client(<?php echo $user['id_client']; ?>);"></span>
    </td>
  </tr>
  <?php }

?>

      </tbody>
    </table>
</div>
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
        <p>&copy; 2024 Gestion des Réservations. Tous droits réservés.</p>
      </div>
      <div class="col-sm-6 text-right">
        <p>Conçu par <a href="https://www.yourwebsite.com" target="_blank">Ichrak Jaifra</a></p>
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
  @media (max-width: 768px) {
      .navbar-inverse .navbar-nav > li > a {
        padding: 10px 15px;
        text-align: center;
      }
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