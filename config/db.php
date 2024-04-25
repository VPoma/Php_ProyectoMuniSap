<?Php

Class Database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'muni_ticket');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

?>