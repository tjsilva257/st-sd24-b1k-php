<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=holland_casino', 'root', '');
}catch (PDOException $e){
    die('Error! ' . $e->getMessage());
}
?>