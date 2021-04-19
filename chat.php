<?php
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Chat</title>
</head>
<body>
    <div id="formcontain">
        <h1>Bienvenue dans le chat</h1>
        <div>
            <P id="user-connect">Connecté en tant que :</P>
        </div>
        <div>
            <p id="message-time">Dernier message a :</p>
        </div>
        <div>
            <form action="chat.php" method="post">
                <textarea name="user-message" id="user-message" cols="30" rows="5" placeholder="Tapez votre message ici..."></textarea><br>
                <input type="submit">
            </form>
            <div id="lastMessage">

            </div>
        </div>
    </div>

</body>
</html>
