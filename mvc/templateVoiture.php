<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<link rel="stylesheet" href="/mvc/assets/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #150050">
        <div class="collapse navbar-collapse" id="navbarColor01">
            <h1 class="navbar-nav nav-item nav-link mr-auto text-muted">MDG TRAVEL</h1>
            <form method="post"  action="<?= URL ?>rechercher/rechercher-clients"  enctype="multipart/form-data" class="d-flex">
                <input class="form-control me-sm-2" type="search" name="term" placeholder="rechercher un client" style="width: 300px;">
                <button name="valider" value="rechercher"class="btn my-2 my-sm-0" type="submit" style="background-color: #BEC3C7 ">rechercher</button>
            </form>
        </div>
    </nav>
  </div>

  <div style="width: 100%" style="min-width: 1300px;">
  <div class="my-2">
  <div class="row vh-100 row min-vw-100">
    <nav class="col-lg-2 d-none d-lg-block sidebar " style="background-color: #046262">
        <ul class="nav flex-column my-3 px-4">
            <li class="nav-item my-2">
                <a class="nav-link btn btn-success" href="<?= URL ?>accueil"><img src="/mvc/public/images/10051890.png" alt="page d'accueil" style="width: 20%"><span style="visibility: hidden;">e</span>Accueil</a>
            </li>
            <li class="nav-item my-3">
                <a class="nav-link  btn btn-danger" href="<?= URL ?>clients"><img src="/mvc/public/images/1533506.png" alt="Listes des clients" style="width: 20%"><span style="visibility: hidden;">e</span>Clients</a>
            </li>
            <li class="nav-item my-3">
                <a class="nav-link  btn btn-warning " href="<?= URL ?>voitures"><img src="/mvc/public/images/5814860.png" alt="Listes voitures" style="width: 20%"><span style="visibility: hidden;">e</span>Voitures</a>
            </li>
            <li class="nav-item my-3">
                <a class="nav-link btn btn btn-secondary " href="<?= URL ?>reservations"><img src="/mvc/public/images/4036829.png" alt="Listes reservations" style="width: 20%"><span style="visibility: hidden;">e</span>Reservations</a>
            </li>
        </ul>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-2 container" style="background-color: #EBF1F1">
      <div class="d-flex justify-contenalign-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $titre ?></h1>
      </div>
      <div style="background-image: url(public/images/depositphotos_165037316-stock-photo-moenchengladbach-germany-april-30-2017.jpg);background-size: cover; background-repeat: no-repeat;height: 100vh; width: 100%; opacity: 0.75;">
      <?= $content ?>
      <canvas class="my-5 w-100" id="myChart" width="900" height="130"></canvas>
      </div>
    </main>
  </div>
</div>      
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

     <script>
      $(document).ready(function(){
        $('#datepicker').datepicker({
          format: 'dd/mm/yyyy',
          autoclose: true,
      todayHighlight: true
    });
    });
</script>
</body>
</html>