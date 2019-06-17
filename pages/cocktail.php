<?php
include('./header.php');
include('../helpers/cocktail.php');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $cocktail->name; ?></title>
</head>
<body>
<?php if ($cocktail): ?>
    <div class="cocktail">
        <?php echo $cocktail->name; ?>
        <div class="cocktail-rating">Rating: <?php echo round($cocktail->rating) ?>/5</div>
        <div class="cocktail-rate">
            Rate this cocktail:
            <?php foreach (range(1, 5) as $rating): ?>
                <a href="../helpers/rate.php?cocktail=<?php echo $cocktail->id; ?>&rating=<?php echo $rating; ?>"><?php echo $rating; ?></a>
            <?php endforeach; ?>

        </div>
        <div class="cocktail-preparation">
            <?php echo $cocktail->zubereitung; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>