<?php
use MyLegacyProject\Manager\LoginManager\LoginManager;
use MyLegacyProject\Manager\LoginManager\LoginManagerException;

session_start();

require_once __DIR__.'/../../vendor/autoload.php';

// Redirect to dashboard if already logged
if (!empty($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

// Initialize LoginManager with hardcoded accounts
$loginManager = new LoginManager();
$credentials = require __DIR__.'/../../data/credentials.php';
foreach ($credentials as $account) {
    $loginManager->addAllowedUser($account['username'], $account['password']);
}

// Handle login
$error = null;
if (isset($_POST['submit'])) {
    try {
        $username = $loginManager->login($_POST['username'], $_POST['password']);
        $_SESSION['username'] = $username;

        header('Location: dashboard.php');
        exit;

    } catch (LoginManagerException $e) {
        $error = $e->getMessage();
    }
}
?>
<html>
	<head>
		<title>Login page</title>
	</head>
	<body>
	<?php
	if ($error !== null) {
	    echo '<p style="color:red;">'.$error.'</p>';
	}
	?>
		<form action="index.php" method="post">
			<ul>
				<li>Username: <input type="text" name="username" /></li>
				<li>Password: <input type="password" name="password" /></li>
			</ul>
			<input type="submit" name="submit" value="Login" />
		</form>
	</body>
</html>