<?php 
	require_once("includes/config.php");
?>

<h1>Home</h1>

<?php
	try {
		$stmt = $db->query('SELECT postID, postTitle, postDesc, 		postDate FROM blog_posts ORDER BY postID DESC');
		while($row = $stmt->fetch()) {
			echo '<div>';
			echo '<h1><ahref="viewpost.php?id='.$row['postID'].'">'.$row['postT			itle'].'</a></h1>';
			echo '<p>Posted on '.date('jS M Y H:i:s', 			strtotime($row['postDate'])).'</p>';
			echo '<p>'.$row['postDesc'].'</p>';
			echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
			echo '</div>';
		}
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>