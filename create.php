<?php
if (isset($_POST['player1']))
{
  require('db.php');
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
  {
    die('Connection failed: ' . $conn->connect_error);
  }
  $sql = "INSERT INTO games (numOfPlayers, name1, name2, name3, name4, points1, points2, points3, points4, bomb1, bomb2, bomb3, bomb4, dealer) VALUES ('".$_POST['numOfPlayers']."', '".$_POST['player1']."', '".$_POST['player2']."', '".$_POST['player3']."', '".$_POST['player4']."', 0, 0, 0, 0, 0, 0, 0, 0, 0)";
  $conn->query($sql);
  $id = $conn->insert_id;
  header('Location: game.php?id='.$id);
  $conn->close();

  $file = fopen('history/'.strval($id).'.log', 'w');
  $text = '<div class="row">';
  for ($i = 0; $i < $_POST['numOfPlayers']; $i++)
    $text .= '<div class="col-'.(12 / $_POST['numOfPlayers']).'">0</div>';
  $text .= '</div>';
  fwrite($file, $text);
  fclose($file);
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
    <header class="container">
      <h2>Tysiąc - liczenie punktów</h2>
    </header>

    <main class="container">
      <form action="create.php" method="POST">
        <label for="number-input">Podaj liczbę graczy</label>
        <select name="numOfPlayers" id="number-input" class="form-control mb-3">
          <option value="2" selected>2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        <input type="text" name="player1" id="p1-input" class="form-control mb-3" placeholder="Imię pierwszego gracza">
        <input type="text" name="player2" id="p2-input" class="form-control mb-3" placeholder="Imię drugiego gracza">
        <input type="text" name="player3" id="p3-input" class="form-control mb-3" placeholder="Imię trzeciego gracza">
        <input type="text" name="player4" id="p4-input" class="form-control mb-3" placeholder="Imię czwartego gracza">
        <button type="submit" class="btn col-12 btn-outline-danger">Utwórz grę</button>
      </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $('#p3-input').hide();
      $('#p4-input').hide();

      $('#number-input').change(function() {
        if ($(this).val() == 2)
        {
          $('#p3-input').hide();
          $('#p4-input').hide();
        }
        else if ($(this).val() == 3)
        {
          $('#p3-input').show();
          $('#p4-input').hide();
        }
        else if ($(this).val() == 4)
        {
          $('#p3-input').show();
          $('#p4-input').show();
        }
      });
    </script>
  </body>
</html>