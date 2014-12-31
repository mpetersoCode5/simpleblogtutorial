<?php include('menu.php'); ?>
<?php 
	require_once("../includes/config.php");
	if(!$user->is_logged_in())
	{
		header('Location: login.php');
	}
?>

<?php
try
{
	$stmt = $db->prepare('SELECT memberID, username, email FROM blog_members WHERE memberID = :memberID');
	$stmt->execute(array(':memberID' => $_GET['id']));
	$row = $stmt->fetch();
} catch(PDOException $e)
{
	echo $e->getMessage();
}
?>

<form action='' method='post'>
	