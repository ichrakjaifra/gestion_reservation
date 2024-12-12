function show_add(){

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"

}
toastr["info"]("user added successfully", "Add user");



}
function show_del(){

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    
    }
    toastr["error"]("user deleted successfully", "Delete user");
    
    
    
    }
    
    function show_update(){

      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      
      }
      toastr["success"]("user update successfully", "Update user");
      
      
      
      }

function confirm_delete_client(id_client){


   let del=confirm("Do you want to delete the user ?");
   console.log(del)
   if(del==true){
        window.location.href="index.php?action=del&&id_client="+id_client;
   }
  }

function edit_client(id_client){
       window.location.href="nouveau_client.php?action=edit&&id_client="+id_client;
}

function confirm_delete_activite(id_activite){


  let del=confirm("Do you want to delete the activité ?");
  console.log(del)
  if(del==true){
       window.location.href="activites.php?action=del&&id_activite="+id_activite;
  }
 }

 function edit_activite(id_activite){
  window.location.href="nouveau_activite.php?action=edit&&id_activite="+id_activite;
}

function confirm_delete_reservation(id_reservation){


  let del=confirm("Do you want to delete the activité ?");
  console.log(del)
  if(del==true){
       window.location.href="reservations.php?action=del&&id_reservation="+id_reservation;
  }
 }

 function edit_reservation(id_reservation){
  window.location.href="nouveau_reservation.php?action=edit&&id_reservation="+id_reservation;
}