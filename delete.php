<?php
if (isset($_GET['id']) && isset($_GET['sure']))
{
  require('db.php');
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
  {
    die('Connection failed: ' . $conn->connect_error);
  }
  $sql = "DELETE FROM games WHERE id=".$_GET['id'];
  $conn->query($sql);
  unlink('history/'.$_GET['id'].'.log');
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <title>Tysiąc - liczenie punktów</title>
  </head>
  <body>
    <main class="container mt-3">
      <h4 style="text-align: center;">Czy na pewno chcesz usunąć grę o numerze <?php echo $_GET['id'];?>?</h4>
      <div class="row mt-3">
        <a href="game.php?id=<?php echo $_GET['id'];?>" class="btn btn-success col-5 m-auto">NIE</a>
        <a href="delete.php?id=<?php echo $_GET['id'];?>&sure=1" class="btn btn-danger col-5 m-auto">TAK</a>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
</html>