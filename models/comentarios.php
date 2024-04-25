<?Php

class Comentarios{
    private $id;
    private $id_ticket;
    private $id_usuario;
    private $mensaje;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getId_ticket(){
        return $this->id_ticket;
    }

    function getId_usuario(){
        return $this->id_usuario;
    }

    function getMensaje(){
        return $this->mensaje;
    }

    function getFecha(){
        return $this->fecha;
    }

    function getHora(){
        return $this->hora;
    }

    function setId($id){
        $this->id = $id;
    }

    function setId_ticket($id_ticket){
        $this->id_ticket = $id_ticket;
    }

    function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    function setHora($hora){
        $this->hora = $hora;
    }

    public function getAll(){
        $comenta = $this->db->query("SELECT * FROM comentarios ORDER BY id DESC;");
        return $comenta;
    }

    public function getOne(){
        $comenta = $this->db->query("SELECT * FROM comentarios WHERE id_ticket = {$this->getId_ticket()} ORDER BY id DESC;");
        return $comenta;
    }

    public function getOnecom(){
        $sql = "SELECT c.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu' FROM comentarios c "
                . "INNER JOIN usuarios u ON u.id = c.id_usuario WHERE c.id_ticket = {$this->getId_ticket()} ORDER BY id DESC;";
        $comenta = $this->db->query($sql);
        return $comenta;
    }

    public function save(){
        $sql = "INSERT INTO comentarios VALUES(NULL, '{$this->getId_ticket()}', '{$this->getId_usuario()}', '{$this->getMensaje()}', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function deletecom(){
        $sql = "DELETE FROM comentarios WHERE id_ticket = {$this->getId_ticket()}";

        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }
}

?>