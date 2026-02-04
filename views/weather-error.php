<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

    <div class="weather-error-container">
        <h1>Oops!</h1>
        <p class="weather-error-message">
            <?= htmlspecialchars(($errorMessage) ?? 'Something went wrong fetching the weather.') ?>
        </p>
        <a href="/" class="back-button">Back to cities list</a>
    </div>

</body>

</html>