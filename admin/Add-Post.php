<?php session_start(); ?>
<?php ob_start(); ?>
<?php include('menu.php'); ?>
<?php 
	require_once("../includes/config.php");
	if(!$user->is_logged_in())
	{
		header('Location: login.php');
	}
?>

<form action='' method='post'>
	<p><label>Title</label><br />
	<input type='text' name='postTitle' value=''></p>
	<p><label>Description</label><br />
	<textarea name='postDesc' cols='60' rows='10'></textarea></p>
	
	<p><label>Content</label><br />
	<textarea name='postCont' cols='60' rows='10'></textarea></p>
	
	<p><input type='submit' name='submit' value='Submit'></p>
	
</form>

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
	tinymce.init({
		selector: "textarea",
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft algincenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
</script>
	
	
	<?php
		//if form has been submitted process it
		if(isset($_POST['submit']))
		{
			$_POST = array_map( 'stripslashes', $_POST);
		
			//collect form data
			extract($_POST);
		
			//very basic validation
			if($postTitle == '')
			{
				$error[] = 'Please enter the title.';
			}
		
			if($postDesc == '')
			{
				$error[] = 'Please enter the description.';
			}
		
			if($postCont == '')
			{
				$error[] = 'Please enter the content.';
			}
		
	
		if(!isset($error))
		{
			try {
			
				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)');
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d H:i:s')
				));
			
			
				//redirect to index page
				header('Location: index.php?action=added');
				exit;
			
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	
		if(isset($error)) {
			foreach($error as $error) {
				echo '<p class="error">'.$error.'</p>';
			}
		}
	}
	?>