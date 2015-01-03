<?php session_start(); ?>
<?php ob_start(); ?>
<?php 
	require_once("../includes/config.php");
	if(!$user->is_logged_in())
	{
		header('Location: login.php');
	}
?>

	<?php
		
		
	$json = json_decode($jsonString);
	
	$postTitle = $json->postTitle;
	$postDesc = $json->postDesc;
	$postCont = $json->postCont;
		
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
			
			
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	?>