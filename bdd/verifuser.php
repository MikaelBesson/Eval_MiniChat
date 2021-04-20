<?php
require_once '../class/db.php';
require_once '../class/user.php';
require_once '../class/sanitize.php';


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
        SELECT pseudo, password FROM user WHERE pseudo=:pseudo');
    $request->bindValue(':pseudo', $pseudo);
    $request->execute();
    if ($request->rowCount() === 0) {
        header('Location:../index.php?error=usernotexist');
    } elseif ($request->rowCount() > 0) {
        $data = $request->fetchAll();
        echo "<pre>";
        print_r([
            'clair' => $password,
            'encoded' => $data[0]['password']
        ]);
        echo "</pre>";

        if (password_verify($password, $data[0]['password'])) {
            header('Location:../chat.php');
        } else {
            header('Location:../index.php?error=mdperror');
        }
    }
}
