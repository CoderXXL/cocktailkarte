<!DOCTYPE HTML>


<html>
<head>
    <title>Login</title>
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
        session_start();
        include('../../helpers/conn.php');
        include('../../helpers/cocktails.php');


        $db;

        if (isset($_GET['login'])) {
            $email = $_POST['email'];
            $passwort = $_POST['passwort'];

            $statement = $db->prepare("SELECT * FROM users WHERE email = :email");
            $result = $statement->execute(array('email' => $email));
            $user = $statement->fetch();

            if ($user !== false && password_verify($passwort, $user['passwort'])) {
                $_SESSION['userid'] = $user['id'];
                die('<div class="card"> Login erfolgreich. Weiter zum <a style="margin-left: 5px  " href="profil.php"> Profil</a></div>');
            } else {
                $errorMessage = "E-Mail oder Passwort war ungültig</ br>";
            }

        }
        ?>

        <?php if (isset($errorMessage)): ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <div class="card">
            <form class="login-form" action="?login=1" method="post" style="width: 500px; text-align: left;">
                <div>
                    <label for="email">E-Mail</label>
                    <input type="email" size="40" id="email" maxlength="250" name="email">
                </div>
    
                <div>
                    <label for="password">Password</label>
                    <input type="password" size="40" id="password" maxlength="250" name="passwort">
                </div>
                <div class="login-form-buttons">
                    <a href="register.php">Regestrieren</a>
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>

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
