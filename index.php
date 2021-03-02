<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo complet lecture SQL.</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php
    $server ='localhost';
    $user = 'root';
    $pass = 'dev';
    $db = 'db_cours';

    try {
        $connect = new PDO("mysql:host=$server,dbname=$db;charset=utf8", $user, $pass);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        /* EXO 1*/
        $stmt = $connect->prepare("SELECT clients FROM user");
        if($stmt) {
            $tadaam = $stmt->fetchAll();
            echo " User : " . $tadaam['lastName'] .$tadaam['firstName']. "<br>";
        }
        $result = $stmt->execute();

        /* exo 2*/
        $stmt = $connect->prepare("SELECT showTypes FROM user");
        if($stmt) {
            $tadaam = $stmt->fetchAll();
            echo " les événements sont : " . $tadaam . "<br>";
        }
        $result = $stmt->execute();

        /*exo 3*/
        $stmt = $connect->prepare("SELECT clients FROM user WHERE id LIMIT 20");
        if($stmt) {
            foreach ($stmt->fetchAll() as $user) {
                echo "user: id->" . $user['id'] . "nom->" .$user['firstName'] ."prenom->" .$user['lastName'] . "<br>";
            }
        }
        $result = $stmt->execute();

        /*EXO 4*/
        $stmt = $connect->prepare("SELECT clients FROM user WHERE card != 0");
        if($stmt) {
            foreach ($stmt->fetchAll() as $user) {
                echo "user: card->" . $user['card'] . "nom->" .$user['firstName'] ."prenom->" .$user['lastName'] . "<br>";
            }
        }
        $result = $stmt->execute();

        /*exo 5*/
        $stmt = $connect->prepare("SELECT clients FROM user ORDER BY firstName, lastName ASC 
                                  AND SELECT clients FROM user WHERE firstName, lastName LIKE 'M%'");
        if($stmt) {
            foreach ($stmt->fetchAll() as $user) {
                echo "Nom: " .$user['firstName'] . "<br>" ."Prenom : " .$user['lastName'] . "<br>";
            }
        }
        $result = $stmt->execute();

        /*exo 6*/
        $stmt = $connect->prepare("SELECT shows FROM user ORDER BY title ASC");
        if($stmt) {
            foreach ($stmt->fetchAll() as $user) {
                echo "Spectacle: " .$user['title'] . "par" .$user['performer'] .  ", le " . $user['date'] . "à partir de "
                     . $user['startTime'] ."<br>";
            }
        }
        $result = $stmt->execute();

        /*exo7*/
        $stmt = $connect->prepare("SELECT clients FROM user ORDER BY id ASC AND WHERE card != 0");
        if($stmt) {
            foreach ($stmt->fetchAll() as $user) {
                echo "Nom: " .$user['firstName'] . "<br>" . "Prenom: " .$user['lastName'] .  "<br> " ."Date de naissance: ". $user['birthDate'] . "<br>"
                   . "Carte de fidélité " . $user['card'] ."<br>" . "<br>" . "Numéro de carte: " . $user['cardNumber'];
            }
        }
        $result = $stmt->execute();

    }
    catch(PDOException $exception) {
        echo $exception->getMessage();
    }
?>
</body>
</html>
