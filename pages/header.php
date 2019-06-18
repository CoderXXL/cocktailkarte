<link rel="stylesheet" href="../style.css">

<meta charset="utf-8"/>
<header>
    <!--        <img src="" alt="logo">-->
    <h1><a href="../index.php">Cocktail Karte</a></h1>
    <nav>
        <a href="cocktails.php">Cocktails</a>
        <?php if (!isset($_SESSION['userid'])): ?>
            <a href="login.php">Login</a>

        <?php else: ?>
            <a href="profil.php">Profil</a>
        <?php endif; ?>
    </nav>
</header>
