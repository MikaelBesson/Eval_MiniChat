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

/**
 * verifie les parametres vide return false
 * @param string ...$params
 * @return bool
 */
function issetPostParams(string ...$params) : bool {
    foreach($params as $param){
        if(!isset($_POST[$param])) {
            return false;
        }
    }
    return true;
}

    //nettoyage des inputs
    /**
     * assainit le contenu d'une varaible
     * @param $data
     * @return string
     */
    function sanitize($data) : string {
        //supprime les espaces
        $data = trim($data);
        //supprime les antislash
        $data = stripslashes($data);
        //transforme les caracteres speciaux en HTML
        $data = htmlspecialchars($data);
        //ajoute des slashes pour eviter les chaine de caractere dans les formulaires
        $data = addslashes($data);
        return $data;
    }

if(issetPostParams('pseudo','password')) {
    $pseudo = sanitize($_POST['pseudo']);
    $password = sanitize($_POST['password']);


    $request = $link->prepare('
        SELECT pseudo, password FROM user WHERE pseudo=:pseudo');
    $request->bindValue(':pseudo',$pseudo);
    $request->execute();
    if($request->rowCount() === 0 ){
        header('Location:inscription.php?error=usernotexist');
    }
    elseif($request->rowCount() > 0) {
        $data = $request->fetchAll();
        if(password_verify($password, $data[0]['password'])){
            header('Location:chat.php');
        }
        else{
            header('Location:index.php?error=mdperror');
        }
    }
}
