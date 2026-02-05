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
    <div class="main-content">
        <div class="app-header">
            <h1>Weather Dashboard</h1>
            <p>Track current weather conditions for your favorite cities. Click a city to view detailed weather information including temperature, humidity, wind speed, and more.</p>
        </div>

        <!-- Unit toggle -->
        <div class="unit-toggle">
            <a href="?unit=metric" class="<?= $currentUnit === 'metric' ? 'active' : '' ?>">°C</a>
            <a href="?unit=imperial" class="<?= $currentUnit === 'imperial' ? 'active' : '' ?>">°F</a>
        </div>

        <!-- Cities list -->
        <div class="cities">
            <?php foreach ($cities as $city): ?>
                <div class="city-row">
                    <a href="/cities/<?= $city['id'] ?>?unit=<?= $currentUnit ?>">
                        <?= htmlspecialchars($city['name']) ?>
                    </a>

                    <!-- Delete button -->
                    <form
                        action="/cities/<?= $city['id'] ?>/delete"
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

        <!-- Add city form -->
        <form action="/cities" method="post" class="add-city-form">
            <input type="text" name="cityName" placeholder="City Name" required>
            <button type="submit">Add City</button>
        </form>
    </div>
</body>

</html>