<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/mvc/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body class="bg-image" style="background-image: url('public/images/rn.jpeg');background-size: cover; background-repeat: no-repeat;height: 100vh; width: 100%; opacity: 0.75;">
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #150050">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <h1 class="navbar-nav nav-item nav-link mr-auto text-muted">MDG TRAVEL</h1>

            <form method="post"  action="<?= URL ?>rechercher/rechercher-clients"  enctype="multipart/form-data" class="d-flex">
                <input class="form-control me-sm-2" type="search" name="term" placeholder="rechercher un client">
                <button name="valider" value="rechercher"class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    
    <div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
      <h1 class="text-light">MDG TRAVEL</h1>
    <main class="container d-flex justify-content-center align-items-center content">
        <h1 class="lead"><a href="<?= URL ?>voitures" class="btn btn-lg fw-bold border-dark bg-secondary text-light">Commencer</a></h1>
    </main>
    </div>
    <!--
    <script src="assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    -->

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