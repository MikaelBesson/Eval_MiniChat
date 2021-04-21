<?php
session_start();
require_once '../class/db.php';

$action = 'list';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action === 'ecrire') {
    insertMessage();
} else {
    getMessages();
}


function insertMessage(){
    if(isset($_POST['usermessage'])){
        $message = $_POST['usermessage'];
    }
    else{
        $message = 'error';
    }

    $db = new db();
    $request = $db->getdbLink();
    $result = $request->prepare("INSERT INTO messages (message, date, user_fk)
                                        VALUES (:message, NOW(), :user_fk)");
    $result->bindvalue(':message', $message);
    $result->bindValue(':user_fk', $_SESSION['user']['id']);
    $result->execute();
}

function getMessages(){
    $db = new db();
    $request = $db->getdbLink();
    $lastMessage = $request->prepare('SELECT * FROM messages, user WHERE user.id=messages.user_fk ORDER BY date DESC LIMIT 10');
    $lastMessage->execute();
    echo json_encode($lastMessage->fetchAll());
}
