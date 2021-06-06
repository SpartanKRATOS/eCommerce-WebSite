// nous avons créé une fonction appelée "deleteme" et l'utilisons lorsque nous cliquons sur le bouton supprimer
// nous prenons le nom d'utilisateur comme paramètre
// les autres comme title, text, icon, etc. c'est juste le JQuery

function deleteme(delid) {
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this account!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      swal("Poof! Your account has been deleted!", {
        icon: "success",
        timer: 2000,
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false,
      });
      setTimeout(function () {
        // lorsque nous cliquons sur ok, nous exécutons ce code, ce code passe le nom d'utilisateur via le lien (méthode GET) à delete.php afin que la page de suppression prenne la valeur et exécute la requête SQL la suppression de ce nom d'utilisateur
        window.location.href = "delete.php?del_id=" + delid + "";
        return true;
      }, 3000); // J'utilise setTimeout juste l'attente 3000 avant de nous rediriger vers la page delete.php afin que vous puissiez voir cette belle animation de fenêtre pop-up
    } else {
      swal("Your account is safe!", { icon: "success" });
    }
  });
}
