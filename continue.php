<?php
require('db.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
  die('Connection failed: ' . $conn->connect_error);
}
$sql = "SELECT * FROM games";
$result = $conn->query($sql);
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
    <header class="container">
      <h2>Tysiąc - liczenie punktów</h2>
    </header>

    <main class="container" style="text-align: center;">
      <?php
        if ($result->num_rows > 0)
        {
          echo '<div class="row mt-3 pb-2" style="border-bottom: 1px solid #666;">
                  <div class="col-2"><b>Numer gry</b></div>
                  <div class="col-7"><b>Imiona graczy</b></div>
                  <div class="col-3"><b>Kontynuuj grę</b></div>
                </div>';
          while ($row = $result->fetch_assoc())
          {
            if ($row['numOfPlayers'] == 2)
              $names = $row['name1'].', '.$row['name2'];
            else if ($row['numOfPlayers'] == 3)
              $names = $row['name1'].', '.$row['name2'].', '.$row['name3'];
            else if ($row['numOfPlayers'] == 4)
              $names = $row['name1'].', '.$row['name2'].', '.$row['name3'].', '.$row['name4'];

            echo '<div class="row mt-3">
              <div class="col-2">'.$row['id'].'</div>
              <div class="col-7">'.$names.'</div>
              <div class="col-3"><a href="game.php?id='.$row['id'].'" class="btn btn-outline-danger col-12">Graj</a></div>
            </div>';
          }
        }
        else
        {
          echo '<div style="text-align: left;">
                  <h5 class="mt-3">Brak rozpoczętych gier</h5>
                  <a href="create.php" class="btn btn-outline-danger">Stwórz nową grę</a>
                </div>';
        }
      ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
</html>