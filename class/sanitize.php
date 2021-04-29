<?php


class sanitize {

    // nettoyage des inputs
    // cleaning of inputs
    /**
     * assainit le contenu d'une variable
     * @param $data
     * @return string
     */
    function verifInput($data) : string {
        //supprime les espaces
        $data = trim($data);
        //supprime les antislash
        $data = stripslashes($data);
        //transforme les caracteres speciaux en HTML
        $data = htmlspecialchars($data);
        //ajoute des slashes pour eviter les chaine
        // de caractere dans les formulaires
        $data = addslashes($data);
        return $data;
    }
    // verifie les parametres si ils sont vide retourne false
    // check the parameters if they are empty returns false
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
}

