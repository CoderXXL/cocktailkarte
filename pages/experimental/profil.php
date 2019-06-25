<!DOCTYPE HTML>
<?php
session_start();
include('../../helpers/conn.php');
include('../../helpers/cocktails.php');

if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="./login.php">einloggen</a>');
}

$userid = $_SESSION['userid'];
$sql = 'SELECT vorname from users WHERE id = ' . $userid;

$data = $db->query($sql)->fetchObject();


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

        <h3>Willkommen bei der besten Cocktailkarte im Internet, <?php echo $data->vorname ?></h3>

    </div>
    <div class="card profil-card">
        <div>
            <button onClick="location.href='logout.php'">Logout</button>

            <button onClick="location.href='./profil.php?changename=true'">Change Username</button>
        </div>

        <?php if(isset($_GET['changename'])): ?>
            <form action="../../helpers/changename.php" method="get">
                <label for="vorname_neu">Enter new name</label>
                <input type="text" name="vorname_neu" id="vorname_neu"/>
                <label for="nachname_neu">Enter new lastname</label>
                <input type="text" name="nachname_neu" id="nachname_neu"/>
                <input type="submit" />
            </form>

        <?php endif; ?>
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
