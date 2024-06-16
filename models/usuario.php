<?Php

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $id_area;
    private $tipo;
    private $id_categoria;
    private $imagen;
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

    function getId_area(){
        return $this->id_area;
    }

    function getId_categoria(){
        return $this->id_categoria;
    }
    
    function getNombre(){
        return $this->nombre;
    }

    function getApellidos(){
        return $this->apellidos;
    }

    function getEmail(){
        return $this->email;
    }

    function getPassword(){
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' =>4]);
    }

    function getTipo(){
        return $this->tipo;
    }

    function getImagen(){
        return $this->imagen;
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

    function setId_area($id_area){
        $this->id_area = $id_area;
    }

    function setId_categoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }

    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password){
        $this->password = $password;
    }

    function setTipo($tipo){
        $this->tipo = $tipo;
    }

    function setImagen($imagen){
        $this->imagen = $imagen;
        //$this->imagen = $this->db->real_escape_string($imagen);
    }

    //variables extra
    function setLimite($limite){
        $this->limite = $limite;
    }

    function setOffset($offset){
        $this->offset = $offset;
    }
    //


    public function getAll(){
        $usuarios = $this->db->query("SELECT * FROM USUARIOS ORDER BY nombre;");
        return $usuarios;
    }

    public function getAllu(){
        $usuarios = $this->db->query("SELECT * FROM USUARIOS ORDER BY nombre;");
        return $usuarios;
    }

    public function getAllp(){
        /*$sql = "SELECT * FROM USUARIOS WHERE id_categoria != 1 ORDER BY nombre;";*/

        $sql = "SELECT u.*, c.nombre As 'catnombre' FROM usuarios u "
                . "INNER JOIN categorias c ON c.id = u.id_categoria WHERE id_categoria != 1 ORDER BY u.id_categoria;";

        $usuarios = $this->db->query($sql);
        return $usuarios;
    }
    
    /*
    public function getAllFilUsr(){
        $sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.tipo, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u "
                . "INNER JOIN areas a ON a.id = u.id_area "
                . "INNER JOIN categorias c ON c.id = u.id_categoria "
                . "WHERE u.nombre like '%{$this->getNombre()}%' AND u.apellidos like '%{$this->getApellidos()}%' "
                . "AND a.id like '%{$this->getId_area()}%' ORDER BY c.nombre;";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }*/

    //Paginador
    public function getAllpag(){
        $sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.tipo, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u "
                . "INNER JOIN areas a ON a.id = u.id_area "
                . "INNER JOIN categorias c ON c.id = u.id_categoria "
                . "LIMIT {$this->getOffset()},{$this->getLimite()};";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }

    public function getAlltotal(){
        $areas  = $this->db->query("SELECT * FROM usuarios");
        return $areas->num_rows;
    }
    //

    public function getAllFilUsr(){
        $sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.tipo, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u "
                . "INNER JOIN areas a ON a.id = u.id_area "
                . "INNER JOIN categorias c ON c.id = u.id_categoria "
                . "WHERE u.nombre like '%{$this->getNombre()}%' AND u.apellidos like '%{$this->getApellidos()}%' "
                . "AND a.id like '%{$this->getId_area()}%'";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }
    
    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getId_area()}', '{$this->getId_categoria()}', '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getTipo()}', '{$this->getImagen()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;

        //comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            //verificar la contraseña
            $verify = password_verify($password, $usuario->password);
            
            if($verify){
                $result = $usuario;
            }
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM usuarios WHERE id = {$this->getId()}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }

    public function getOne(){
        $usuario = $this->db->query("SELECT id, nombre, apellidos, email, password, id_area, tipo, id_categoria, imagen FROM usuarios WHERE id = {$this->getId()};");
        return $usuario->fetch_object();
    }

    public function edit(){
        $sql = "UPDATE usuarios SET id_area = '{$this->getId_area()}', id_categoria = '{$this->getId_categoria()}', nombre = '{$this->getNombre()}', apellidos = '{$this->getApellidos()}', email = '{$this->getEmail()}', password = '{$this->getPassword()}', tipo = '{$this->getTipo()}' ";
        
        if($this->getImagen() != null){
            $sql .= ", imagen = '{$this->getImagen()}'";
        }

        $sql .= " WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function editus(){
        $sql = "UPDATE usuarios SET nombre = '{$this->getNombre()}', apellidos = '{$this->getApellidos()}', email = '{$this->getEmail()}' ";
        
        if($this->getImagen() != null){
            $sql .= ", imagen = '{$this->getImagen()}'";
        }

        $sql .= " WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function editps(){
        $sql = "UPDATE usuarios SET password = '{$this->getPassword()}' WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

}

    /*
    public function getAllts(){
        $sql = "SELECT u.*, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u INNER JOIN areas a ON a.id = u.id_area INNER JOIN categorias c ON c.id = u.id_categoria;";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }
    //RECORDAR SIEMPRE QUE AL DAR UN SALTO DE LINEA EN LA SENTENCIA SQL SE DEBE CONSIDERAR UN ESPACIO " "
    //DE LO CONTRARIO LA SENTENCIA SE JUNTA EJEM: SIN ESPACIO-> ... FROM USUARIOS UINNER JOIN AREAS ...
    */
    /*
    public function getAllusr(){
        $sql = "SELECT u.*, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u "
                . "INNER JOIN areas a ON a.id = u.id_area "
                . "INNER JOIN categorias c ON c.id = u.id_categoria ORDER BY c.nombre;";
        $usuarios = $this->db->query($sql);
        return $usuarios;
    }*/

?>