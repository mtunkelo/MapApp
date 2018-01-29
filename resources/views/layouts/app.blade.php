
<!DOCTYPE html>
<html lang="fi">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Paikat</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="/css/style.css"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body id="body">
  <div class="container">
    <div class="row">

  <h1>Parhaat paikat</h1>

@yield('content')

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzysIWEDuVN3lW_WgcO_e-95kKnWrvJxM&callback=initMap"></script>

<script src="js/actions.js"></script>

</body>
</html>
