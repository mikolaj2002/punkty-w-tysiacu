<?php
if (isset($_GET['id']) && isset($_GET['p']) && isset($_GET['d']))
{
	require('db.php');
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
	  die('Connection failed: ' . $conn->connect_error);
	}
	$sql = "UPDATE games SET bomb".$_GET['p']."=1, dealer=".$_GET['d']." WHERE id=".$_GET['id'];
	$conn->query($sql);
	$conn->close();
	header('Location: game.php?id='.$_GET['id']);
}
else
	header('Location: index.php');