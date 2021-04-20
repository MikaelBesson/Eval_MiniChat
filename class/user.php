<?php
require_once 'sanitize.php';



class user {
    private PDO $db;

    public function __construct(PDO $database)  {
        $this->db = $database;
    }

    // recupere les users

    public function getUsers() {
        $data = $this->db->prepare('SELECT * FROM user');
        $data->execute();
        foreach($data->fetchAll() as $datas){
            echo $datas['nom'] . '<br>' . $datas['prenom'] . '<br>';

        }
    }

    // insertion des users
    public function insertUser () {

        $verif = new sanitize();

        $name = $verif->verifInput($_POST['name']);
        $lastname = $verif->verifInput($_POST['lastname']);
        $pseudo = $verif->verifInput($_POST['pseudo']);
        $pass = $verif->verifInput($_POST['password']);
        $email = $verif->verifInput($_POST['email']);

        $request = $this->db->prepare("INSERT INTO user (nom, prenom, pseudo, password, email)
                    VALUES (:name,:lastname,:pseudo,:password,:email)");

        $request->bindValue(':name',$name);
        $request->bindValue(':lastname',$lastname);
        $request->bindValue(':pseudo',$pseudo);
        $request->bindValue(':password',password_hash($pass,PASSWORD_DEFAULT));
        $request->bindValue(':email',$email);
        $request->execute();
    }
}