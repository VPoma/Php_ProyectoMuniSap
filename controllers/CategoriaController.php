<?Php

require_once 'models/categoria.php';

class categoriaController{
    
    public function index(){
        echo "Controlador Categoria, Accion Index";
    }

    public function registro(){
        require_once 'views/categoria/registroCa.php';
    }

    public function save(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            if($nombre && $descripcion){
                $categoria = new Categoria;
                $categoria->setNombre($nombre);
                $categoria->setDescripcion($descripcion);

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $categoria->setId($id);

                    $save = $categoria->edit();
                }else{
                    $save = $categoria->save();
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
        //header("location:".base_url.'usuario/registro');
        //echo '<script>window.location="'.base_url.'categoria/registro"</script>';
        echo '<script>window.location="'.base_url.'categoria/gestion"</script>';
    }

    public function gestion(){
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/gestionCa.php';
    }

    public function delete(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $delete = $categoria->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }

        echo '<script>window.location="'.base_url.'categoria/gestion"</script>';
    }

    public function edit(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $categoria = new Categoria();
            $categoria->setId($id);
            
            $cat = $categoria->getOne();

            require_once 'views/categoria/registroCa.php';
        }else{
            //header('Location:'.base_url.'categoria/gestion');
            echo '<script>window.location="'.base_url.'categoria/gestion"</script>';
        }
    }

    public function eliminar(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = true;

            $categoria = new Categoria();
            $categoria->setId($id);
            
            $cat = $categoria->getOne();

            require_once 'views/categoria/eliminarCa.php';
        }else{
            //header('Location:'.base_url.'categoria/gestion');
            echo '<script>window.location="'.base_url.'categoria/gestion"</script>';
        }
    }
}

/*
                var_dump($categoria);
            }
        }
    }
}
*/
?>