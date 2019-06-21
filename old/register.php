<?php
session_start();
include('./helpers/conn.php');
include('./header.php');
$db;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
</head>
<body>

<?php
$showFormular = true;

if (isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if (strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if ($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    if (!$error) {
        $statement = $db->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if ($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    if (!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $db->prepare("INSERT INTO users (email, passwort, vorname, nachname) VALUES (:email, :passwort, :vorname, :nachname)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname));
        if ($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="./login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if ($showFormular) {
    ?>

    <form action="?register=1" method="post" style="width: 500px; text-align: right;">
        <div>
            <label for="email">E-Mail:</label>
            <input type="email" size="40" maxlength="250" id="email" name="email">
        </div>
        <div>
            <label for="vorname">Vorname:</label>
            <input type="text" size="40" maxlength="250" id="vorname" name="vorname" required>
        </div>
        <div>
            <label for="nachname">Nachname:</label>
            <input type="text" size="40" maxlength="250" id="nachname" name="nachname" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" size="40" id="password" maxlength="250" name="passwort">
        </div>
        <div>
            <label for="password2">Password Wiederholen:</label>
            <input type="password" size="40" maxlength="250" id="password2" name="passwort2">
        </div>

        <a href="login.php">Login</a>
        <input type="submit" value="Abschicken">
    </form>

    <?php
}
?>

</body>
</html>
