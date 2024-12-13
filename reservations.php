<?php
include_once('db.php');
$action = false;
if (isset($_POST['Ajouter'])) {

  $id_client = $_POST['id_client'];
  $id_activite = $_POST['id_activite'];
  $date_reservation = $_POST['date_reservation'];
  $statut = $_POST['statut'];
  if ($_POST['Ajouter'] == "Ajouter") {
    $save_sql = "INSERT INTO `reservation`( `id_client`, `id_activite`, `date_reservation`, `statut`) VALUES 
          ('$id_client','$id_activite','$date_reservation','$statut')";
  }else{
    $id_reservation= $_POST['id_reservation'] ;
    $save_sql = "UPDATE `reservation` SET `id_client`='$id_client',`id_activite`='$id_activite' ,`date_reservation`='$date_reservation' ,
    `statut`='$statut' WHERE id_reservation =$id_reservation " ;
    }
  

  $res_save = mysqli_query($con, $save_sql);
  if (!$res_save) {
    die(mysqli_error($con));

  } else {
    if (isset($_POST['id_reservation'])){
      $action = "edit";
    }else{
      $action = "add";
    }

  }

}
if (isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id_reservation'])) {
  $id_reservation= $_GET['id_reservation'];
  $del_sql = "DELETE FROM reservation WHERE id_reservation = $id_reservation";
  $res_del = mysqli_query($con, $del_sql);
  if (!$res_del) {
    die(mysqli_error($con));

  } else {
    $action = "del";
  }
}
$reservations_sql = "SELECT * FROM reservation";
$all_reservation = mysqli_query($con, $reservations_sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/toster.css">
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
    <a href="nouveau_reservation.php" class="btn btn-success btn-lg">
      <i class="glyphicon glyphicon-plus"></i> Nouvelle reservation
    </a>
</div>    
  </div>

<div class="container" style="margin-top: 70px;">
  <div class="panel panel-primary">
  <div class="panel-heading">Liste des réservations</div>
  <div class="panel-body">
  <div class="table-responsive">
  <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id reservation</th><th>Id client</th><th>Id activite</th><th>Date reservation</th><th>Status</th><th>Actions</th>
        </tr>
      </thead>

      <tbody>
      <?php
while ($reservation = $all_reservation->fetch_assoc()) { ?>

<tr>

    <td>
    <?php echo $reservation['id_reservation']; ?>  
    </td>
    <td>
    <?php echo $reservation['id_client']; ?>  
    </td>
    <td>
    <?php echo $reservation['id_activite']; ?>
    </td>
    <td>
    <?php echo $reservation['date_reservation']; ?>
    </td>
    <td>
    <?php echo $reservation['statut']; ?>
    </td>
    
    <td>
      <!-- <div class="d-flex p-2 justify-content-evenly mb-2">

        <i onclick="confirm_delete();" class="text-danger" data-feather="trash-2"></i>
        <i onclick="edit();" class="text-success" data-feather="edit"></i>
      </div> -->
      <span class="glyphicon glyphicon-edit" onclick="edit_reservation(<?php echo $reservation['id_reservation']; ?>);"></span>
      &nbsp;
      <span class="glyphicon glyphicon-trash" onclick="confirm_delete_reservation(<?php echo $reservation['id_reservation']; ?>);"></span>
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