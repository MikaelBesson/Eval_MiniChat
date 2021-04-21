<?php
    if(isset($_GET['deconnection']) && $_GET['deconnection'] === '1' ) {
        session_unset();
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
    <title>login</title>
</head>
<body>
    <div id="formcontain">
        <h1>Bienvenue dans le chat !</h1>

        <form action="./bdd/verifuser.php" method="post">
            <div>
                <label for="pseudo">Entre ton pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" required>
            </div>
            <div>
                <label for="password">Entre ton password :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <input type="submit">
            </div>
            <div>
                <a href="./inscription.php">Tu n'est pas encore inscrit ? Clique ici !</a>
            </div>
        </form>
        <div id="message"></div>
    </div>


</body>
</html>
