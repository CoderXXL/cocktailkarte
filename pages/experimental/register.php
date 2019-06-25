<!DOCTYPE HTML>
<?php
session_start();
include('../../helpers/conn.php');
include('../../helpers/cocktails.php');
$db;
?>
<html>
<head>
    <title>Hallo <?php echo $data->vorname ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="../../assets/css/main.css"/>
    <link rel="stylesheet" href="../../style.css"/>
    <noscript>
        <link rel="stylesheet" href="../../assets/css/noscript.css"/>
    </noscript>
</head>
<body class="is-preload">

<div id="wrapper">
    <header id="header">
        <h1><a href="index.php"><strong>Cocktails</strong> get in touch</a></h1>
        <nav>
            <ul>
                <li><a href="#footer" class="icon solid fa-info-circle">Mehr</a></li>
            </ul>
        </nav>
    </header>


    <div id="main">

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
            <div class="card">
                <form action="?register=1" method="post" style="width: 500px; text-align: leaft;">
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
            </div>

            <?php
        }
        ?>


    </div>


    <footer id="footer" class="panel">
        <div class="inner split">
            <div>
                <section>
                    <button onClick="location.href='index.php'">Cocktails</button>
                    <?php if (!isset($_SESSION['userid'])): ?>
                        <button onClick="location.href='login.php'">Login</button>
                    <?php else: ?>
                        <button onClick="location.href='profil.php'">Profil</button>
                    <?php endif; ?>
                </section>
            </div>
            <div>
                <section>
                    <h2>Request new Cocktails: </h2>
                    <form method="post" action="#">
                        <div class="fields">
                            <div class="field half">
                                <input type="text" name="name" id="name" placeholder="Name"/>
                            </div>
                            <div class="field half">
                                <input type="text" name="email" id="email" placeholder="Email"/>
                            </div>
                            <div class="field">
                                <textarea name="message" id="message" rows="4" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="Send" class="primary"/></li>
                            <li><input type="reset" value="Reset"/></li>
                        </ul>
                    </form>
                </section>
            </div>
        </div>
    </footer>

</div>

<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.poptrox.min.js"></script>
<script src="../../assets/js/browser.min.js"></script>
<script src="../../assets/js/breakpoints.min.js"></script>
<script src="../../assets/js/util.js"></script>
<script src="../../assets/js/main.js"></script>

</body>
</html>
