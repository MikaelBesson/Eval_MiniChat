<?php


class user {
    private PDO $db;

    public function __construct(PDO $database) {
        $this->db = $database;
    }

    // recupere les users

    public function getUser () {
        $data = $this->db->prepare('SELECT * FROM user');
        $data->execute();
        foreach($data->fetchAll() as $datas){
            echo $datas['nom'] . '<br>' . $datas['prenom'] . '<br>';
        }
    }

    // insertion des users
    public function insertUser () {

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
         * assainit le contenu d'une variable
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

        $name = sanitize($_POST['name']);
        $lastname = sanitize($_POST['lastname']);
        $pseudo = sanitize($_POST['pseudo']);
        $pass = sanitize($_POST['password']);
        $email = sanitize($_POST['email']);

        $request = $this->db->prepare("INSERT INTO minichat.user (nom, prenom, pseudo, password, email)
                    VALUES (:name,:lastname,:pseudo,:password,:email)");

        $request->bindValue(':name',$name);
        $request->bindValue(':lastname',$lastname);
        $request->bindValue(':pseudo',$pseudo);
        $request->bindValue(':password',password_hash($pass,PASSWORD_DEFAULT));
        $request->bindValue(':email',$email);
        $request->execute();
    }
}