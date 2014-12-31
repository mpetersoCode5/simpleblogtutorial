<?php
	try
	{
		$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts WHERE postID = :postID');
		$stmt->execute(array(':postID' => $_GET['id']));
		$row = $STMT->fetch();
	} catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	
?>
<?php include('menu.php'); ?>
<?php 
	require_once("../includes/config.php");
	if(!$user->is_logged_in())
	{
		header('Location: login.php');
	}
?>

<form action='' method='post'>
	<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>
	
	<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTItle'];?>'>
	</p>
	
	<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea>
	</p>
	
	<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea>
	</p>
	
	<p><input type='submit' name='submit' value='Update'></p>
	
</form>