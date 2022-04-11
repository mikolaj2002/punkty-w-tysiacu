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
    $n = $row['numOfPlayers'];
    $dealer = $row['dealer'];
    $d = ($row['dealer'] + 1) % $row['numOfPlayers'];

    $names = [];
    $points = [];
    for ($i = 0; $i < $n; $i++)
    {
      $names[] = $row['name'.($i + 1)];
      $points[] = $row['points'.($i + 1)];
    }
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
          for ($i = 0; $i < $n; $i++)
            echo '<div class="col-'.(12 / $n).'">
                    <b>'.$names[$i].'</b>'.
                    ($dealer == $i ? '<span>&clubs;</span>' : '').
                  '</div>';
        ?>
      </div>
      <div class="row mt-3">
        <?php
          for ($i = 0; $i < $n; $i++)
            echo '<div class="col-'.(12 / $n).'" id="name'.($i + 1).'">'.$points[$i].'</div>';
        ?>
      </div>
      <form action="add_points.php?id=<?php echo($_GET['id'].'&d='.$d);?>" method="POST">
        <div class="row mt-3">
          <?php
            for ($i = 0; $i < $n; $i++)
              echo '<div class="col-'.(12 / $n).'"><input type="number" name="p'.($i + 1).'" id="p'.($i + 1).'-input" class="form-control" placeholder="Punkty gracza" value="0"></div>';
            for ($i = $n; $i < 4; $i++)
              echo '<input type="hidden" name="p'.($i + 1).'" value="0">';
          ?>
        </div>
        <div class="row mt-3">
          <?php
            for ($i = 0; $i < $n; $i++)
            {
              echo '<div class="col-'.(12 / $n).'">';
              if ($row['bomb'.($i + 1)] == 0)
              {
                if ($d == $i)
                  echo('<a href="bomb.php?id='.$_GET['id'].'&p='.($i + 1).'&d='.$d.'" class="btn btn-outline-secondary">Rzuć bombę &#128163;</a>');
                else
                  echo('<div class="text-secondary">Rzuć bombę (w innej rundzie) &#128163;</div>');
              }
              else
                echo('<div class="text-secondary">Rzucono bombę &#128163;</div>');
              echo '</div>';
            }
          ?>
        </div>
        <input type="submit" value="Dodaj punkty" class="btn col-12 btn-outline-danger mt-3">
      </form>
      <p><a href="history.php?id=<?php echo $_GET['id'];?>" class="btn btn-outline-secondary mt-3">Pokaż historię</a></p>
      <p><a href="delete.php?id=<?php echo $_GET['id'];?>" class="btn btn-outline-secondary">Usuń grę</a></p>
    </main>

    <footer>
      Gra o numerze <?php echo $_GET['id'];?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $('#name1').click(function() {
        $('#p1-input').val(-100);
      });
      $('#name2').click(function() {
        $('#p2-input').val(-100);
      });
      $('#name3').click(function() {
        $('#p3-input').val(-100);
      });
      $('#name4').click(function() {
        $('#p4-input').val(-100);
      });

      $('.form-control').change(function() {
        if ($(this).val() == '')
          $(this).val(0);
      });
    </script>
  </body>
</html>