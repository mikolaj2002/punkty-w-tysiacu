<?php
if (isset($_GET['id']) && isset($_POST['p1']))
{
	require('db.php');
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
	  die('Connection failed: ' . $conn->connect_error);
	}
	$sql = "UPDATE games SET points1=points1+".$_POST['p1'].", points2=points2+".$_POST['p2'].", points3=points3+".$_POST['p3'].", points4=points4+".$_POST['p4'].", dealer=".$_GET['d']." WHERE id=".$_GET['id'].";";
	$conn->query($sql);
	$sql = "SELECT * FROM games WHERE id=".$_GET['id'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$number = $row['numOfPlayers'];
	$points = [$row['points1'], $row['points2'], $row['points3'], $row['points4']];
	$conn->close();

	if ($_POST['p1'] != 0 || $_POST['p2'] != 0 || $_POST['p3'] != 0 || $_POST['p4'] != 0)
	{
		$file = fopen('history/'.$_GET['id'].'.log', 'a');
		$text = '<div class="row mt-3">';
		for ($i = 0; $i < $number; $i++)
		  $text .= '<div class="col-'.(12 / $number).'">'.$points[$i].'</div>';
		$text .= '</div>';
		fwrite($file, $text);
		fclose($file);
	}

	header('Location: game.php?id='.$_GET['id']);
}

else
	header('Location: index.php');