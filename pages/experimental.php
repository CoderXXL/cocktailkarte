<!DOCTYPE HTML>
<?php
include('../helpers/conn.php');
include('../helpers/cocktails.php');


?>
<html>
<head>
    <title>Cocktails</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="../assets/css/main.css"/>
    <noscript>
        <link rel="stylesheet" href="../assets/css/noscript.css"/>
    </noscript>
</head>
<body class="is-preload">

<div id="wrapper">
    <header id="header">
        <h1><a href="experimental.php"><strong>Cocktails</strong> get in touch</a></h1>
        <nav>
            <ul>
                <li><a href="#footer" class="icon solid fa-info-circle">Mehr</a></li>
            </ul>
        </nav>
    </header>


    <div id="main">
        <?php foreach ($cocktails as $cocktail): ?>
            <article class="thumb">
                <a href="../images/fulls/01.jpg" class="image"><img src="../images/thumbs/0<?php echo $cocktail->id ?>.jpg"
                                                                    alt="<?php echo $cocktail->name ?>"/></a>
                <h2><a href="cocktail.php?id=<?php echo $cocktail->id; ?>"><?php echo $cocktail->name; ?></a></h2>
                <p>Zubereitung: <br /> <?php echo $cocktail->zubereitung ?></p>
            </article>
        <?php endforeach; ?>

    </div>

    <footer id="footer" class="panel">
        <div class="inner split">
            <div>
                <section>
                    <h2>lol</h2>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam.</p>
                </section>
                <section>
                    <h2>lol</h2>

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

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.poptrox.min.js"></script>
<script src="../assets/js/browser.min.js"></script>
<script src="../assets/js/breakpoints.min.js"></script>
<script src="../assets/js/util.js"></script>
<script src="../assets/js/main.js"></script>

</body>
</html>