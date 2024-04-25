<?php

class Utils{

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function showCatTick(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAllTick();
        return $categorias;
    }

    public static function showAreas(){
        require_once 'models/area.php';
        $area = new Area();
        $areas = $area->getAll();
        return $areas;
    }

    public static function showUsuario(){
        require_once 'models/usuario.php';
        $usuario = new Usuario();
        $usuarios = $usuario->getAllu();
        return $usuarios;
    }

    public static function showPersonal(){
        require_once 'models/usuario.php';
        $persona = new Usuario();
        $personal = $persona->getAllp();
        return $personal;
    }
}

?>