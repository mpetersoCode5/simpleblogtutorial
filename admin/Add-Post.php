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
	<input type='text' name='postTitle' value='<?php if(isset($error)){echo $_POST['postTitle'];}?>'></p>
	<p><label>Description</label><br />
	<textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>
	
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
	}
	
	if(!isset($error))
	{
		try {
			
			//insert into database
			$stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)');
			$stmt->execute(array(
				':postTitle' => $postTitle,
				':postDesc' => $postCont,
				':postDate' => date('Y-m-d H:i:s')
			));
			
		}
	}
?>