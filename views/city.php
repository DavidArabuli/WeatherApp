<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>

    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

    <?php
    $tempUnit = $unit === 'imperial' ? '°F' : '°C';
    $windUnit = $unit === 'imperial' ? 'mph' : 'm/s';
    ?>
    <div class="unit-toggle unit-toggle--detail">
        <a href="?unit=metric" class="<?= $unit === 'metric' ? 'active' : '' ?>">°C</a>
        <a href="?unit=imperial" class="<?= $unit === 'imperial' ? 'active' : '' ?>">°F</a>
    </div>

    <div class="weather-card">

        <h1 class="city-title">
            <?= htmlspecialchars($weather['city']) ?>
        </h1>


        <div class="weather-details">

            <div>
                <span>Temperature:</span>
                <strong><?= htmlspecialchars($weather['temperature']) ?><?= $tempUnit ?></strong>
            </div>
            <div>
                <span>Weather conditions:</span>
                <strong><?= ucfirst(htmlspecialchars($weather['description'])) ?></strong>
            </div>
            <div>
                <span>Humidity:</span>
                <strong><?= htmlspecialchars($weather['humidity']) ?>%</strong>
            </div>

            <div>
                <span>Wind:</span>
                <strong><?= htmlspecialchars($weather['wind_speed']) ?> <?= $windUnit ?></strong>
            </div>
        </div>

        <a href="/" class="back-button">← Back to cities</a>

    </div>

</body>

</html>