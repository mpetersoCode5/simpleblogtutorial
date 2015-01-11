<?php session_start(); ?>
<?php ob_start(); ?>

<?php

class EditPostAPI
{
	function editPost()
	{
		require_once("../includes/config.php");
		if(isset($_POST["postID"]) && isset($_POST["postTitle"]) && isset($_POST["postDesc"]) && isset($_POST["postCont"]))
		{
			$postID = $_POST["postID"];
			$postTitle = $_POST["postTitle"];
			$postDesc = $_POST["postDesc"];
			$postCont = $_POST["postCont"];
			
			try
			{
				$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID');
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));
				
				echo 'Success';
			} catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
}

$api = new EditPostAPI;
$api->editPost();

?>