<?php
    require_once './class/db.php';
    require_once './class/user.php';


    $db = new db;
    $link = $db->getdbLink();
    $user = new user($link);
    $user->getUser();
    if(isset($_GET['insertion'])){
        $user->insertUser();
    }
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Inscription</title>
</head>
<body>
    <div id="formcontain">
        <h1>Inscription</h1>
        <form action="./class/user.php" method="post">
            <div>
                <label for="name">Entre ton Nom :</label>
                <input type="text" name="name" id="name" required>
                <label for="lastname">Entre ton Prenom :</label>
                <input type="text" name="lastname" id="lastname" required>
            </div>

            <div>
                <label for="pseudo">Choisie un Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" required>
            </div>
            <div>
                <label for="password">Entre un mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label for="confirm-password">Confirme ton mot de passe :</label>
                <input type="password" name="confirm-password" id="confirm-password" required>
            </div>
            <div>
                <label for="email">Entre une adresse email valide :</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>

    </div>

</body>
</html>




