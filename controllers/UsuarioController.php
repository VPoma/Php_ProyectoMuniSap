<?Php

require_once 'models/usuario.php';
require_once 'models/area.php';
require_once 'models/categoria.php';

class usuarioController{
    
    public function index(){
        echo "Controlador Usuarios, Accion Index";
    }

    public function registro(){
        //Conseguir Area
        //$area = new Area();
        //$areas = $area->getAll();

        //Conseguir Catgoria
        //$categoria = new Categoria();
        //$categorias = $categoria->getAll();

        require_once 'views/usuario/registroU.php';
    }

    public function save(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $area = isset($_POST['area']) ? $_POST['area'] : false;
            $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if($nombre && $apellidos && $email && $password){
                $usuario = new Usuario;
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setId_area($area);
                $usuario->setTipo($tipo);
                $usuario->setId_categoria($categoria);

                //Guardar la imagen
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                            
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
                        $usuario->setImagen($filename); //8:26 -283
                    }
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $usuario->setId($id);

                $save = $usuario->edit();
                }else{
                $save = $usuario->save();
                }

                if($save){
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
        }else{
            $_SESSION['register'] = "failed";
        }

        //header("location:".base_url.'usuario/gestion');
        echo '<script>window.location="'.base_url.'usuario/gestion"</script>';
        
    }

    public function login(){
        if(isset($_POST)){
            //Identificar al usuario
            //consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login();

            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;

                if($identity->tipo == 'employed'){
                    $_SESSION['employed'] = true;
                }

                if($identity->tipo == 'admin'){
                    $_SESSION['admin'] = true;
                }

            }else{
                $_SESSION['error_login'] = 'Identifiación fallida !!';
            }
        }
        echo '<script>window.location="'.base_url.'"</script>';
    }

    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }

        if(isset($_SESSION['employed'])){
            unset($_SESSION['employed']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }

        echo '<script>window.location="'.base_url.'"</script>';

    }

    public function gestion(){
        //Paginador
        if(isset($_GET['pag'])){
            $pag = $_GET['pag'];
        }else{
            $pag = 1;
        }

        $limite = 6;
        $offset = ($pag-1)*$limite;

        $usuario = new Usuario();
        $usuario->setOffset($offset);
        $usuario->setLimite($limite);
        $usuarios = $usuario->getAllpag();

        $total = $usuario->getAlltotal();

        $totalP = ceil($total/$limite);
        $totalPag = $totalP;

        require_once 'views/usuario/gestionU.php';
    }

    public function filtrousr(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $area = isset($_POST['area']) ? $_POST['area'] : false;

            $usuario = new Usuario();

            /*Utilizando strlen(trim($?)) para calcular la cantidad de digitos
            Logre realizar la consulta IF*/
            if(strlen(trim($area)) == 0 && strlen(trim($nombre)) == 0 && strlen(trim($apellidos)) == 0){      
            /*
                $limite = 6;
                $offset = 0;
                $usuario->setOffset($offset);
                $usuario->setLimite($limite);
                $usuarios = $usuario->getAllpag();
        
                $total = $usuario->getAlltotal();
        
                $totalP = ceil($total/$limite);
                $totalPag = $totalP;*/

                echo '<script>window.location="'.base_url.'usuario/gestion"</script>';
            }else{
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setId_area($area);
                $usuarios = $usuario->getAllFilUsr();
            }

        }
        require_once 'views/usuario/gestionU.php';
    }

    public function delete(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);
            $delete = $usuario->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }

        echo '<script>window.location="'.base_url.'usuario/gestion"</script>';
    }

    public function edit(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            
            $user = $usuario->getOne();

            require_once 'views/usuario/registroU.php';
        }else{
            echo '<script>window.location="'.base_url.'usuario/gestion"</script>';
        }
    }

    public function eliminar(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            
            $user = $usuario->getOne();

            require_once 'views/usuario/eliminarU.php';
        }else{
            //header('Location:'.base_url.'usuario/gestion');
            echo '<script>window.location="'.base_url.'usuario/gestion"</script>';
        }
    }

    public function editu(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            
            $user = $usuario->getOne();

            require_once 'views/usuario/soloeditaU.php';
        }else{
            echo '<script>window.location="'.base_url.'"</script>';
        }
    }

    public function saveuser(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;

            if($nombre && $apellidos && $email){
                $usuario = new Usuario;
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);

                //Guardar la imagen
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                            
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
                        $usuario->setImagen($filename); //8:26 -283
                    }
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $usuario->setId($id);

                $save = $usuario->editus();
                }

                if($save){
                    $_SESSION['r'] = "c";
                }else{
                    $_SESSION['r'] = "f";
                }
            }else{
                $_SESSION['r'] = "f";
            }
        }else{
            $_SESSION['r'] = "f";
        }

        //header("location:".base_url.'usuario/registro');
        echo '<script>window.location="'.base_url.'"</script>';
        
    }

    public function editp(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            
            $user = $usuario->getOne();

            require_once 'views/usuario/passeditaU.php';
        }else{
            echo '<script>window.location="'.base_url.'"</script>';
        }
    }

    public function savepass(){
        if(isset($_POST)){
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($password){
                $usuario = new Usuario;
                $usuario->setPassword($password);

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $usuario->setId($id);

                $save = $usuario->editps();
                }

                if($save){
                    $_SESSION['r'] = "c";
                }else{
                    $_SESSION['r'] = "f";
                }
            }else{
                $_SESSION['r'] = "f";
            }
        }else{
            $_SESSION['r'] = "f";
        }

        //header("location:".base_url.'usuario/registro');
        echo '<script>window.location="'.base_url.'"</script>';
        
    }
}

?>