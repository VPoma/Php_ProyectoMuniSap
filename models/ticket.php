<?Php

class Ticket{
    private $id;
    private $id_usuario;
    private $id_upersonal;
    private $id_categoria;
    private $asunto;
    private $descripcion;
    private $estado;
    private $fecha_ini;
    private $fecha_fin;
    private $horain;
    //variables extra
    private $limite;
    private $offset;
    //
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getId_usuario(){
        return $this->id_usuario;
    }

    function getId_upersonal(){
        return $this->id_upersonal;
    }

    function getId_categoria(){
        return $this->id_categoria;
    }
    
    function getAsunto(){
        return $this->asunto;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function getEstado(){
        return $this->estado;
    }

    function getFecha_ini(){
        return $this->fecha_ini;
    }

    function getFecha_fin(){
        return $this->fecha_fin;
    }

    function getHorain(){
        return $this->horain;
    }

    //variables extra
    function getLimite(){
        return $this->limite;
    }

    function getOffset(){
        return $this->offset;
    }
    //

    function setId($id){
        $this->id = $id;
    }

    function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    function setId_upersonal($id_upersonal){
        $this->id_upersonal = $id_upersonal;
    }

    function setId_categoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }

    function setAsunto($asunto){
        $this->asunto = $this->db->real_escape_string($asunto);
    }

    function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setEstado($estado){
        $this->estado = $this->db->real_escape_string($estado);
    }

    function setFecha_ini($fecha_ini){
        $this->fecha_ini = $fecha_ini;
    }

    function setFecha_fin($fecha_fin){
        $this->fecha_fin = $fecha_fin;
    }

    function setHorain($horain){
        $this->horain = $horain;
    }

    //variables extra
    function setLimite($limite){
        $this->limite = $limite;
    }

    function setOffset($offset){
        $this->offset = $offset;
    }
    //    

    public function save(){
        $sql = "INSERT INTO tickets VALUES(NULL, '{$this->getId_usuario()}', (SELECT id FROM usuarios WHERE id_categoria = '{$this->getId_categoria()}' ORDER BY RAND () LIMIT 1), '{$this->getId_categoria()}', '{$this->getAsunto()}', '{$this->getDescripcion()}', 'PENDIENTE', CURDATE(), CURDATE(), CURRENT_TIME());";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function getAll(){
        $tickets = $this->db->query("SELECT * FROM tickets ORDER BY id DESC;");
        return $tickets;
    }
    
    //Paginador
    public function getAllpag(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria "
                . "ORDER BY id DESC LIMIT {$this->getOffset()},{$this->getLimite()};";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }

    public function getAllpage(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria "
                . "WHERE t.id_upersonal = {$this->getId_upersonal()} ORDER BY id DESC LIMIT {$this->getOffset()},{$this->getLimite()};";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }

    public function getAllpagu(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria "
                . "WHERE t.id_usuario = {$this->getId_usuario()} ORDER BY id DESC LIMIT {$this->getOffset()},{$this->getLimite()};";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }

    public function getAlltotal(){
        $areas  = $this->db->query("SELECT * FROM tickets");
        return $areas->num_rows;
    }

    public function getAlltotale(){
        $areas  = $this->db->query("SELECT * FROM tickets WHERE id_upersonal = {$this->getId_upersonal()}");
        return $areas->num_rows;
    }

    public function getAlltotalu(){
        $areas  = $this->db->query("SELECT * FROM tickets WHERE id_usuario = {$this->getId_usuario()}");
        return $areas->num_rows;
    }
    //Paginador

    public function getAlltick(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria ORDER BY id desc;";
                //. "INNER JOIN categorias c ON c.id = t.id_categoria ORDER BY c.nombre;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function getAllticke(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id_upersonal = {$this->getId_upersonal()} ORDER BY id DESC;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function getAllticku(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id_usuario = {$this->getId_usuario()} ORDER BY id DESC;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function getAllfiltick(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id like '%{$this->getId()}%' "
                . "AND u.apellidos like '%{$this->getId_usuario()}%' AND ue.apellidos like '%{$this->getId_upersonal()}%' "
                . "AND t.fecha_ini like '%{$this->getFecha_ini()}%' AND t.id_categoria like '%{$this->getId_categoria()}%' "
                . "AND t.estado like '%{$this->getEstado()}%' ORDER BY id DESC;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function getAllfilticke(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id_upersonal = {$this->getId_upersonal()} "
                . "AND t.id like '%{$this->getId()}%' AND u.apellidos like '%{$this->getId_usuario()}%' "
                . "AND t.fecha_ini like '%{$this->getFecha_ini()}%' AND t.id_categoria like '%{$this->getId_categoria()}%' "
                . "AND t.estado like '%{$this->getEstado()}%' ORDER BY id DESC;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function getAllfilticku(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id_usuario = {$this->getId_usuario()} "
                . "AND t.id like '%{$this->getId()}%' AND ue.apellidos like '%{$this->getId_upersonal()}%' "
                . "AND t.fecha_ini like '%{$this->getFecha_ini()}%' AND t.id_categoria like '%{$this->getId_categoria()}%' "
                . "AND t.estado like '%{$this->getEstado()}%' ORDER BY id DESC;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function getOne(){
        $ticket = $this->db->query("SELECT * FROM tickets WHERE id = {$this->getId()};");
        return $ticket->fetch_object();
    }

    public function getOnetic(){
        $sql = "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', " 
                . "ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t "
                . "INNER JOIN usuarios u ON u.id = t.id_usuario " 
                . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal "
                . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id = {$this->getId()};";
        $ticket = $this->db->query($sql);
        return $ticket->fetch_object();
    }

    public function delete(){
        $sql = "DELETE FROM tickets WHERE id = {$this->getId()}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }

    public function edit(){
        $sql = "UPDATE tickets SET id_upersonal = (SELECT id FROM usuarios WHERE id_categoria = '{$this->getId_categoria()}' ORDER BY RAND () LIMIT 1), id_categoria = '{$this->getId_categoria()}', asunto = '{$this->getAsunto()}', descripcion = '{$this->getDescripcion()}' WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function edites(){
        $sql = "UPDATE tickets SET estado = '{$this->getEstado()}', fecha_fin = CURDATE() WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function admtickcant(){
        $sql = "SELECT u.nombre as 'nombre', u.apellidos as 'apellidos', c.nombre as 'categoria', COUNT(t.id) as 'cantidad' FROM tickets t "
                . "INNER JOIN categorias c ON c.id = t.id_categoria "
                . "INNER JOIN usuarios u ON u.id = t.id_upersonal GROUP BY u.apellidos;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function emptickcant(){
        $sql = "SELECT c.nombre as 'categoria', t.estado as 'estado', COUNT(t.id) as 'cantidad' FROM tickets t "
                . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id_upersonal = {$this->getId_upersonal()} GROUP BY t.estado DESC;";
        $ticket = $this->db->query($sql);
        return $ticket;
    }

    public function edittadm(){
        $sql = "UPDATE tickets SET estado = '{$this->getEstado()}', id_usuario = '{$this->getId_usuario()}', id_categoria = '{$this->getId_categoria()}', id_upersonal = '{$this->getId_upersonal()}', asunto = '{$this->getAsunto()}', descripcion = '{$this->getDescripcion()}', fecha_fin = '{$this->getFecha_fin()}' WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

}

?>