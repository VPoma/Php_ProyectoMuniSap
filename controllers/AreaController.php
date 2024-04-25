<?Php

require_once 'models/area.php';

class areaController{
    
    public function index(){
        echo "Controlador Area, Accion Index";
    }

    public function registro(){
        require_once 'views/area/registroA.php';
    }

    public function save(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            if($nombre &&  $descripcion){
                $area = new Area;
                $area->setNombre($nombre);
                $area->setDescripcion($descripcion);
                
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $area->setId($id);

                    $save = $area->edit();
                }else{
                    $save = $area->save();
                }
                
                if($save){
                    $_SESSION['register'] = 'complete';
                }else{
                    $_SESSION['register'] = 'failed';
                }
            }else{
                $_SESSION['register'] = 'failed';
            }
        }else{
            $_SESSION['register'] = 'failed';
        }
        echo '<script>window.location="'.base_url.'area/gestion"</script>';
    }

    public function gestion(){
        $area = new Area();
        $areas = $area->getAll();

        require_once 'views/area/gestionA.php';
    }

    public function delete(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $area = new Area();
            $area->setId($id);
            $delete = $area->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }

        echo '<script>window.location="'.base_url.'area/gestion"</script>';
    }

    public function edit(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $area = new Area();
            $area->setId($id);
            
            $are = $area->getOne();

            require_once 'views/area/registroA.php';
        }else{
            //header('Location:'.base_url.'area/gestion');
            echo '<script>window.location="'.base_url.'area/gestion"</script>';
        }
    }

    public function eliminar(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = true;

            $area = new Area();
            $area->setId($id);
            
            $are = $area->getOne();

            require_once 'views/area/eliminarA.php';
        }else{
            //header('Location:'.base_url.'area/gestion');
            echo '<script>window.location="'.base_url.'area/gestion"</script>';
        }
    }

}
/*var_dump($area);}}*/
?>