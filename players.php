<?php

require 'db.php';
global $db;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!empty($id)) {
    $query = $db->prepare('SELECT * FROM player WHERE game_id = :id');
    $query->bindParam('id', $id);
    $query->execute();

    $players = $query->fetchAll(PDO::FETCH_ASSOC);
}else{
    die('Error 404! Item not found');
}
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
<table>
    <thead>
    <tr>
        <th scope="col">Naam</th>
        <th scope="col">Leeftijd</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($players as $player):?>
        <tr>
            <td><?= $player['name'] ?></td>
            <td><?= $player['age'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
