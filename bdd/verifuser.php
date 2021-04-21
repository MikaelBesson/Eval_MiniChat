<?php
require_once '../class/db.php';
require_once '../class/user.php';
require_once '../class/sanitize.php';
session_start();

$db = new db;
$link = $db->getdbLink();
$user = new user($link);
$user->getUsers();
if (isset($_GET['insertion'])) {
    $user->insertUser();
}

$isset = new sanitize();

if ($isset->issetPostParams('pseudo', 'password')) {
    $verif = new sanitize();
    $pseudo = $verif->verifInput($_POST['pseudo']);
    $password = $verif->verifInput($_POST['password']);

    $request = $link->prepare('
        SELECT id, pseudo, password FROM user WHERE pseudo=:pseudo');
    $request->bindValue(':pseudo', $pseudo);
    $request->execute();
    if ($request->rowCount() === 0) {
        header('Location:../index.php?error=usernotexist');
    } elseif ($request->rowCount() > 0) {
        $data = $request->fetchAll();
        $_SESSION['user']['id']= $data[0]['id'];
        $_SESSION['user']['pseudo']= $data[0]['pseudo'];


        if (password_verify($password, $data[0]['password'])) {
            header('Location:../chat.php');
        } else {
            header('Location:../index.php?error=mdperror');
        }
    }
}
