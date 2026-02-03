<?php
// temp
$cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix'];
var_dump($cities);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($cities as $city): ?>
        <br>
        <a href="/cities/<?= urlencode($city) ?>">
            <?= htmlspecialchars($city) ?>

        </a>
    <?php endforeach; ?>

</body>

</html>