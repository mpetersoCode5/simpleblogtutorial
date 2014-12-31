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

<script language="Javascript" type="text/javascript">
function delUser(id, title)
{
	if(confirm("Are you sure you want to delete '" + title + "'"))
	{
		window.location.href = 'users.php?deluser=' + id;
	}
}
</script>

<?php
if(isset($_GET['deluser']))
{
	//if user id is 1 ignore
	if($_GET['deluser'] != '1')
	{
		$stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID');
		$stmt->execute(array(':memberID' => $_GET['deluser']));
		
		header('Location: users.php?action=deleted');
		exit;
	}
}
?>