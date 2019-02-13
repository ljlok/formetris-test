<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>
<html>
	<head>
		<title>My Dashboard</title>
	</head>
	<body>
		<h1>Welcome to your dashboard, <?=$_SESSION['username']?>!</h1>

		<ul>
			<li><a href="trees.php">Outstanding trees in Paris</a></li>
			<li><a href="random-tree.php">Get a random tree in Paris</a></li>
		</ul>

		<ul>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</body>
</html>