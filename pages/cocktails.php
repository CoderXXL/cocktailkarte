<?php
include('./header.php');
include('../helpers/cocktails.php')
?>


<!doctype>
<html>
<head>
    <meta charset="utf-8">
    <title>Cocktails</title>
</head>
<body>
<h1>List of all Cocktails: </h1>
<table>

    <?php foreach ($cocktails as $cocktail): ?>
        <div class="cocktail">
            <h3 class="cocktail-name">
                <a href="cocktail.php?id=<?php echo $cocktail->id; ?>"><?php echo $cocktail->name ?></a>
            </h3>
            <p class="cocktail-preparation">
                <?php echo $cocktail->zubereitung ?>

            </p>
        </div>
        <div class="cocktail-rating">Rating: <?php echo round($cocktail->rating) ?>/5</div>

    <?php endforeach; ?>
</table>
</body>
</html>