<?php
session_start();
include('./header.php');
include('../helpers/cocktail.php');


$hasRated = false;
if ($db->query("SELECT user FROM rating WHERE cocktail = {$cocktail->id} AND user = {$_SESSION['userid']}")->fetch()[0] === $_SESSION['userid']) {
    $hasRated = true;
} else {
    $hasRated = false;
}

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
            <?php if ($hasRated): ?>
                <p>You all ready rated this Cocktail, <a href="../helpers/rate.php?delete=1&user=<?php echo $userId ?>&cocktail=<?php echo $cocktail->id; ?>">Delete?</a></p>
            <?php else: ?>
                <p>Rate this cocktail: </p>
                <?php foreach (range(1, 5) as $rating): ?>
                    <a href="../helpers/rate.php?cocktail=<?php echo $cocktail->id; ?>&rating=<?php echo $rating; ?>&user=<?php echo $userId ?>"><?php echo $rating; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="cocktail-preparation">
            <?php echo $cocktail->zubereitung; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>