<?php session_start(); ?>
<?php ob_start(); ?>

<?php
	
class AddUserAPI
{
	function addUser()
	{
		require_once("../includes/config.php");
		if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]))
		{
			$hashedpassword = $user->create_hash($password);
			
			try
			{
				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_members (username,password,email) VALUES (:username, :password, :email)');
				$stmt->execute(array(
					':username' => $username,
					':password' => $hashedpassword,
					':email' => $email
				));
				
				echo 'Success';
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		else
		{
			echo 'Failure';
		}
	}
}

$api = new AddUserAPI;
$api->addUser();

?>