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
	<input type='hidden' name='memberID' value='<?php echo $row['memberID'];?>'>
	
	<p><label>Username</label><br />
		<input type='text' name='username' value='<?php echo $row['username'];?>'>
	</p>
	
	<p><label>Password (only to change)</label><br/>
		<input type='password' name='password' value=''>
	</p>
	
	<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' value=''>
	</p>
	
	<p><label>Email</label><br />
		<input type='text' name='email' value='<?php echo $row['email']; ?>'>
	</p>
	
	<p><input type='submit' name='submit' value='Update User'></p>
	
</form>

<?php
if(strlen($password) > 0)
{
	if($password == '')
	{
		$error[] = 'Please enter the password';
	}
	if($passwordConfirm == '')
	{
		$error[] = 'Please confirm the password';
	}
	
	if($password != $passwordConfirm)
	{
		$error[] = 'Passwords do not match.'
	}
}

$_POST = arry_map('stripslashes', $_POST);

extract($_POST);

if(isset($password))
{
	$hashedpassword = $user->create_hash($password);
	
	//update into database
	$stmt = $db->prepare('UPDATE blog_members SET username = :username, password = :password, email = :email WHERE memberID = :memberID');
	$stmt->exectue(array(
		':username' => $username,
		':password' => $hashedpassword,
		':email' => $email,
		':memberID' => $memberID
	));
}
else
{
	//update into database
	$stmt = $db->prepare('UPDATE blog_members SET username = :username, email = :email WHERE memberID = :memberID');
	$stmt->exectue(array(
		':username' => $username,
		':email' => $email,
		':memberID' => $memberID
}

header('Location: users.php?action=updated');
exit;

?>