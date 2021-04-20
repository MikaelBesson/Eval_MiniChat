<?php
session_start();

class messages {

    private PDO $db;

    public function __construct(PDO $database)  {
        $this->db = $database;
    }

    public function insertMessage (){

        $message = $_POST['message'];


        $request = $this->db->prepare("INSERT INTO messages (message, date, user_fk)
                                        VALUES (:message, NOW(), :user_fk)");

        $request->bindvalue('message', $message);
        $request->bindValue('user_fk',$_SESSION['user']['id']);
        $request->execute();
    }

}