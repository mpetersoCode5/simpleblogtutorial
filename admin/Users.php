<?php include('menu.php'); ?>
<?php 
	require_once("../includes/config.php");
	if(!$user->is_logged_in())
	{
		header('Location: login.php');
	}
?>

<?php
	$stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
	while($row = $stmt->fetch())
	{
		echo '<tr>';
		echo '<td>'.$row['username'].'</td>';
		echo '<td>'.$row['email'].'</td>';
		?>
		
		<td>
			<a href="edit-user.php?id=<?php echo $row['memberID'];?>">Edit</a>
			<?php if($row['memberID'] != 1){}?>
			<a href="havascript:deluser('<?php echo row['memberID'];?>','<?php echo $row['username'];?>')">Delete</a>
			<?php } ?>
		</td>
		
		<?php
		echo '</tr>';
	}
?>