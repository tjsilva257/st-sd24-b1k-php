<?php

require 'db.php';
global $db;

const NAME_REQUIRED = 'Vul je naam in';
const MIN_BET_REQUIRED = 'Vul een minimale inzet in';
const MIN_BET_POSITIVE = 'De minimale inzet moet een positief getal zijn';

$errors = [];
$inputs = [];

if (isset($_POST['submit'])){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($name)){
        $errors['name'] = NAME_REQUIRED;
    } else{
        $inputs['name'] = $name;
    }

    $minBet = filter_input(INPUT_POST, 'min-bet', FILTER_VALIDATE_INT);

    if ($minBet === false || $minBet === null || $minBet < 0){
        $errors['min-bet'] = $minBet < 0 ? MIN_BET_POSITIVE : MIN_BET_REQUIRED;
    } else{
        $inputs['min-bet'] = $minBet;
    }

    if (count($errors) === 0){
        $query = $db->prepare('INSERT INTO games (name, min_bet) VALUES (:name, :min_bet)');
        $query->bindParam('name', $inputs['name']);
        $query->bindParam('min_bet', $inputs['min-bet']);
        $query->execute();

        header('Location: index.php');
    }
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
<form method="post">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name" value="<?= $inputs['name'] ?? '' ?>">
    <div><?= $errors['name'] ?? '' ?></div>
    <label for="min-bet">Minimale inzet</label>
    <input type="number" name="min-bet" id="min-bet" value="<?= $inputs['min-bet'] ?? '' ?>">
    <div><?= $errors['min-bet'] ?? '' ?></div>
    <button name="submit">Verzenden</button>
</form>
</body>
</html>
