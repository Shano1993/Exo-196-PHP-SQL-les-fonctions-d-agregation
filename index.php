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
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.

    try {
        $server = 'localhost';
        $db = 'base_exo196';
        $user = 'root';
        $password = '';

        $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Age minimum des utilisateurs
        $stmt = $pdo->prepare("SELECT MIN(age) as minimum FROM user");
        if ($stmt->execute()) {
            $min = $stmt->fetch();
            echo "L'âge minimum est de " . $min['minimum'] . " ans" . "<br>";
        }

        // Age maximum des utilisateurs
        $stmt = $pdo->prepare("SELECT MAX(age) as maximum FROM user");
        if ($stmt->execute()) {
            $max = $stmt->fetch();
            echo "L'âge maximum est de " . $max['maximum'] . " ans" . "<br>";
        }

        // Nombre d'utilisateurs
        $stmt = $pdo->prepare("SELECT count(*) as number FROM user");
        if ($stmt->execute()) {
            $number = $stmt->fetch();
            echo "Le nombre d'utilisateurs est de  " . $number['number'] . "<br>";
        }

        // Nombre d'utilisateurs avec un numéro supérieur a 5
        $stmt = $pdo->prepare("SELECT count(*) as number FROM user WHERE rue >= 5");
        if ($stmt->execute()) {
            $count = $stmt->fetch();
            echo "Le nombre d'utilisateurs est de  " . $count['number'] . "<br>";
        }

        // Moyenne d'âge des utilisateurs
        $stmt = $pdo->prepare("SELECT AVG(age) as average FROM user");
        if ($stmt->execute()) {
            $average = $stmt->fetch();
            echo "La moyenne des âges des utilisateurs est de  " . $average['average'] . " ans" . "<br>";
        }

        // Somme des numéros de maisons des utilisateurs
        $stmt = $pdo->prepare("SELECT SUM(numero) as house FROM user");
        if ($stmt->execute()) {
            $house = $stmt->fetch();
            echo "La somme des numéros des utilisateurs est de " . $house['house'];
        }

    }

    catch (Exception $exception) {
        echo $exception->getMessage();
    }
    ?>
</body>
</html>

