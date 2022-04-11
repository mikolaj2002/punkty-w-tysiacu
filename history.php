<?php
if (isset($_GET['id']))
{
  require('db.php');
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
  {
    die('Connection failed: ' . $conn->connect_error);
  }
  $sql = "SELECT * FROM games WHERE id=".$_GET['id'];
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    $row = $result->fetch_assoc();
    $names = [$row['name1'], $row['name2'], $row['name3'], $row['name4']];
    $number = $row['numOfPlayers'];
  }
  else
    header('Location: index.php');
  $conn->close();
}
else
  header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/game.css">

    <title>Tysiąc - liczenie punktów</title>
  </head>
  <body>
    <header class="container">
      <h2>Tysiąc - liczenie punktów</h2>
    </header>

    <main class="container">
      <div class="row mt-3">
      <?php
        for ($i = 0; $i < $number; $i++)
          echo '<div class="col-'.(12 / $number).'""><b>'.$names[$i].'</b></div>';
      ?>
      </div>
      <?php
        echo file_get_contents('history/'.$_GET['id'].'.log');
      ?>
      <a href="game.php?id=<?php echo $_GET['id'];?>" class="btn col-12 btn-outline-secondary mt-3">Wróc do strony gry</a>
    </main>

    <footer>
      Gra o numerze <?php echo $_GET['id'];?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
</html>