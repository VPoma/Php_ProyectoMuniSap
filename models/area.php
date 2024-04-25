<?Php

class Area{
    private $id;
    private $nombre;
    private $descripcion;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }
    
    function getNombre(){
        return $this->nombre;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function setId($id){
        $this->id = $id;
    }

    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getAll(){
        $areas = $this->db->query("SELECT * FROM areas ORDER BY id DESC;");
        return $areas;
    }

    public function save(){
        $sql = "INSERT INTO areas VALUES(NULL, '{$this->getNombre()}', '{$this->getDescripcion()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM areas WHERE id =  {$this->getId()}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }

    public function getOne(){
        $area = $this->db->query("SELECT * FROM areas WHERE id = {$this->getId()};");
        return $area->fetch_object();
    }

    public function edit(){
        $sql = "UPDATE areas SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}' WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

}

?>