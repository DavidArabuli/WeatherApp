<?php
$currentUnit = $_GET['unit'] ?? 'metric';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities</title>

    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

    <div class="unit-toggle">
        <a href="?unit=metric" class="<?= $currentUnit === 'metric' ? 'active' : '' ?>">°C</a>
        <a href="?unit=imperial" class="<?= $currentUnit === 'imperial' ? 'active' : '' ?>">°F</a>
    </div>

    <div class="cities">
        <?php foreach ($cities as $city): ?>
            <div class="city-row">
                <a href="/cities/<?= urlencode($city['name']) ?>?unit=<?= $currentUnit ?>">
                    <?= htmlspecialchars($city['name']) ?>
                </a>

                <form
                    action="/cities/<?= urlencode($city['name']) ?>/delete"
                    method="post"
                    class="delete-form">
                    <button
                        type="submit"
                        onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars($city['name']) ?>?');">
                        Delete
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="/cities" method="post" class="add-city-form">
        <input type="text" name="cityName" placeholder="City Name" required>
        <button type="submit">Add City</button>
    </form>

</body>

</html>