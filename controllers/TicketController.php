<?Php

require_once 'models/ticket.php';
require_once 'models/comentarios.php';
use \Spipu\Html2Pdf\Html2Pdf;

class ticketController{
    
    public function index(){
        echo "Controlador Ticket, Accion Index";
    }

    public function registro(){
        require_once 'views/ticket/registrot.php';
    }

    public function save(){
        if(isset($_POST)){
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            if($usuario && $categoria && $asunto && $descripcion){
                $ticket = new Ticket;
                $ticket->setId_usuario($usuario);
                $ticket->setId_categoria($categoria);
                $ticket->setAsunto($asunto);
                $ticket->setDescripcion($descripcion);

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $ticket->setId($id);

                    $save = $ticket->edit();
                }else{
                    $save = $ticket->save();
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
        echo '<script>window.location="'.base_url.'ticket/gestion"</script>';
    }

    public function gestion(){
        $ticket = new Ticket();

        if(isset($_SESSION['admin'])){
            $tickets = $ticket->getAllfiltick();
        }elseif(isset($_SESSION['employed'])){
            $id = $_SESSION['identity']->id;
            $ticket->setId_upersonal($id);
            $tickets = $ticket->getAllfilticke();
        }elseif(isset($_SESSION['identity'])){
            $id = $_SESSION['identity']->id;
            $ticket->setId_usuario($id);
            $tickets = $ticket->getAllticku();
        }

        require_once 'views/ticket/gestiont.php';
    }

    public function filtrotick(){
        if(isset($_POST)){
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $personal = isset($_POST['personal']) ? $_POST['personal'] : false;
            $fechaini = isset($_POST['fechaini']) ? $_POST['fechaini'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            
            $ticket = new Ticket();
            $ticket->setId($id);
            $ticket->setId_usuario($usuario);
            $ticket->setId_upersonal($personal);
            $ticket->setFecha_ini($fechaini);
            $ticket->setId_categoria($categoria);
            $ticket->setEstado($estado);

            //$tickets = $ticket->getAllfiltick();

            if(isset($_SESSION['admin'])){
                $tickets = $ticket->getAllfiltick();
            }elseif(isset($_SESSION['employed'])){
                $ida = $_SESSION['identity']->id;
                $ticket->setId_upersonal($ida);
                $tickets = $ticket->getAllfilticke();
            }elseif(isset($_SESSION['identity'])){
                $ida = $_SESSION['identity']->id;
                $ticket->setId_usuario($ida);
                $tickets = $ticket->getAllfilticku();
            }
        }
        require_once 'views/ticket/gestiont.php';
    }

    public function eliminar(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = true;

            $ticket = new Ticket();
            $ticket->setId($id);
            
            $tic = $ticket->getOne();

            require_once 'views/ticket/eliminart.php';
        }else{
            //header('Location:'.base_url.'ticket/gestion');
            echo '<script>window.location="'.base_url.'ticket/gestion"</script>';
        }
    }

    public function delete(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $ticket = new Ticket();
            $ticket->setId($id);
            $delete = $ticket->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }

        echo '<script>window.location="'.base_url.'ticket/gestion"</script>';
    }

    public function edit(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $ticket = new Ticket();
            $ticket->setId($id);
            
            $tic = $ticket->getOne();

            require_once 'views/ticket/registrot.php';
        }else{
            echo '<script>window.location="'.base_url.'ticket/gestion"</script>';
        }
    }

    public function follow(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $follow = true;

            $ticket = new Ticket();
            $ticket->setId($id);
            $tic = $ticket->getOnetic();

            //Busqueda con filtro x id_ticket
            $comen = new Comentarios();
            $comen->setId_ticket($id);
            $coment = $comen->getOnecom();

            require_once 'views/ticket/seguimientot.php';
        }else{
            echo '<script>window.location="'.base_url.'ticket/gestion"</script>';
        }
    }

    public function savec(){

        if(isset($_POST)){
            $ticket = isset($_POST['ticket']) ? $_POST['ticket'] : false;
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : false;


            if($ticket && $usuario && $mensaje){
                $comen = new Comentarios();

                $comen->setId_ticket($ticket);
                $comen->setId_usuario($usuario);
                $comen->setMensaje($mensaje);

                $save = $comen->save();

                if($save){
                    $_SESSION['s'] = "c";
                }else{
                    $_SESSION['s'] = "f";
                }
            }else{
                $_SESSION['s'] = "f";
            }
        }else{
            $_SESSION['s'] = "f";
        }
        echo '<script>window.location="'.base_url.'ticket/follow&id='.$ticket.'"</script>';
    }

    public function savee(){
        if(isset($_POST)){
            $id = isset($_POST['id_ticket']) ? $_POST['id_ticket'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;

            if($estado){
                $ticket = new Ticket;
                $ticket->setEstado($estado);

                if(isset($id)){
                    $ticket->setId($id);
                    $save = $ticket->edites();
                }

                if($save){
                    $_SESSION['s'] = "c";
                }else{
                    $_SESSION['s'] = "f";
                }
            }else{
                $_SESSION['s'] = "f";
            }
        }else{
            $_SESSION['s'] = "f";
        }
        echo '<script>window.location="'.base_url.'ticket/follow&id='.$id.'"</script>';
    }

    public function gestionadm(){
        $ticket = new Ticket();
        $tickets = $ticket->getAllfiltick();
        $ticktadmcant = $ticket->admtickcant();

        require_once 'views/admticket/gestiontadm.php';

    }

    public function filtrotickadm(){
        if(isset($_POST)){
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $personal = isset($_POST['personal']) ? $_POST['personal'] : false;
            $fechaini = isset($_POST['fechaini']) ? $_POST['fechaini'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            
            $ticket = new Ticket();
            $ticket->setId($id);
            $ticket->setId_usuario($usuario);
            $ticket->setId_upersonal($personal);
            $ticket->setFecha_ini($fechaini);
            $ticket->setId_categoria($categoria);
            $ticket->setEstado($estado);

            $tickets = $ticket->getAllfiltick();
            $ticktadmcant = $ticket->admtickcant();
        }
        require_once 'views/admticket/gestiontadm.php';
    }

    public function gestionemp(){
        $ticket = new Ticket();

        if(isset($_SESSION['employed'])){
            $id = $_SESSION['identity']->id;
            $ticket->setId_upersonal($id);
            $ticktempcant = $ticket->emptickcant();
        }

        require_once 'views/admticket/gestiontemp.php';

    }

    public function followadm(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $follow = true;

            $ticket = new Ticket();
            $ticket->setId($id);
            $tic = $ticket->getOnetic();

            //Busqueda con filtro x id_ticket
            $comen = new Comentarios();
            $comen->setId_ticket($id);
            $coment = $comen->getOnecom();

            require_once 'views/admticket/seguimientotadm.php';
        }else{
            echo '<script>window.location="'.base_url.'ticket/gestionadm"</script>';
        }
    }

    public function editadm(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $ticket = new Ticket();
            $ticket->setId($id);
            
            $tic = $ticket->getOne();

            require_once 'views/admticket/editatadm.php';
        }else{
            echo '<script>window.location="'.base_url.'ticket/gestionadm"</script>';
        }
    }

    public function savetadm(){
        if(isset($_POST)){
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $personal = isset($_POST['personal']) ? $_POST['personal'] : false;
            $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $fechafin = isset($_POST['fechafin']) ? $_POST['fechafin'] : false;

            if($estado && $usuario && $categoria && $personal && $asunto && $descripcion && $fechafin){
                $ticket = new Ticket;
                $ticket->setEstado($estado);
                $ticket->setId_usuario($usuario);
                $ticket->setId_categoria($categoria);
                $ticket->setId_upersonal($personal);
                $ticket->setAsunto($asunto);
                $ticket->setDescripcion($descripcion);
                $ticket->setFecha_fin($fechafin);

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $ticket->setId($id);

                    $save = $ticket->edittadm();
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
        echo '<script>window.location="'.base_url.'ticket/gestionadm"</script>';
    }

    public function eliminaradm(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = true;

            $ticket = new Ticket();
            $ticket->setId($id);
            $tic = $ticket->getOne();

            require_once 'views/admticket/eliminartadm.php';
        }else{
            //header('Location:'.base_url.'ticket/gestionadm');
            echo '<script>window.location="'.base_url.'ticket/gestionadm"</script>';
        }
    }

    public function deleteadm(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $comen = new Comentarios();
            $comen->setId_ticket($id);
            $coment = $comen->deletecom();

            $ticket = new Ticket();
            $ticket->setId($id);
            $delete = $ticket->delete();

            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }

        echo '<script>window.location="'.base_url.'ticket/gestionadm"</script>';
    }

    public function reporte(){
        
        require_once 'views/reporte/report.php';
    }

}
?>