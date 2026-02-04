<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
</head>

<body>
    <?php
    $tempUnit = $unit === 'imperial' ? '°F' : '°C';
    $windUnit = $unit === 'imperial' ? 'mph' : 'm/s';
    ?>
    <p>detailed information for <?= htmlspecialchars($title) ?></p>
    <p>Temperature: <?= htmlspecialchars($weather['temperature']) ?><?= $tempUnit ?></p>
    <p>Humidity: <?= htmlspecialchars($weather['humidity']) ?>%</p>
    <p>Wind Speed: <?= htmlspecialchars($weather['wind_speed']) ?> <?= $windUnit ?></p>
    <p>Description: <?= htmlspecialchars($weather['description']) ?></p>
</body>

</html>