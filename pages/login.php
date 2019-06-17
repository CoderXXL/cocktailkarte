<?php
session_start();
include('../helpers/conn.php');
include('./header.php');

$db;

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $db->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zum <a href="profil.php">Profil</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig</ br>";
    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php if (isset($errorMessage)): ?>
    <p><?php echo $errorMessage; ?></p>
<?php endif; ?>

<form action="?login=1" method="post" style="width: 500px; text-align: right;">
    <div>
        <label for="email">E-Mail</label>
        <input type="email" size="40" id="email" maxlength="250" name="email">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" size="40" id="password" maxlength="250" name="passwort">
    </div>

    <a href="register.php">Regestrieren</a>
    <input type="submit" value="Login">
</form>
</body>
</html>
