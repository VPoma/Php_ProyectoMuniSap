<?Php

class Categoria{
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
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY nombre;");
        return $categorias;
    }

    public function getAllTick(){
        $categorias = $this->db->query("SELECT * FROM categorias WHERE id > 1 AND id != 43 ORDER BY nombre;");
        return $categorias;
    }

    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}', '{$this->getDescripcion()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM categorias WHERE id = {$this->getId()}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }

    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()};");
        return $categoria->fetch_object();
    }

    public function edit(){
        $sql = "UPDATE categorias SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}' WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

}

?>