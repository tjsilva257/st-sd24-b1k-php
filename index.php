<?php

require 'db.php';
global $db;

$query = $db->prepare('SELECT * FROM games');
$query->execute();

$games = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="insert.php">Toevoegen</a>
<table>
    <thead>
    <tr>
        <th scope="col">Naam</th>
        <th scope="col">Minimale inzet</th>
        <th scope="col">Spelers</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($games as $game):?>
    <tr>
        <td><?= $game['name'] ?></td>
        <td><?= $game['min_bet'] ?></td>
        <td><a href="players.php?id=<?= $game['id'] ?>">Spelers</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
