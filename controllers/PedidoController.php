<?php

require_once 'models/pedido.php';
require_once 'models/usuario.php';

class pedidoController{



public function hacer(){
    require_once 'views/pedido/hacer.php';
}

public function add(){
    if(isset($_SESSION['identity'])){
        $usuario_id = $_SESSION['identity']->id;
        $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
        $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
        
        $stats = Utils::statsCarrito();
        $coste = $stats['total'];
            
        if($departamento && $municipio && $direccion){
            // Guardar datos en bd
            $pedido = new Pedido();
            $pedido->setUsuario_id($usuario_id);
            $pedido->setDepartamento($departamento);
            $pedido->setMunicipio($municipio);
            $pedido->setDireccion($direccion);
            $pedido->setCoste($coste);
            
            $save = $pedido->save();
            
            // Guardar linea pedido
            $save_linea = $pedido->save_linea();
            
            if($save && $save_linea){
                $_SESSION['pedido'] = "complete";
            }else{
                $_SESSION['pedido'] = "failed";
            }
            
        }else{
            $_SESSION['pedido'] = "failed";
        }
        
        header("Location:".'?controller=pedido&action=confirmado');			
    }else{
        // Redigir al index
        header("Location:".base_url);
    }
}

public function confirmado(){
    if(isset($_SESSION['identity'])){
        $identity = $_SESSION['identity'];
        $pedido = new Pedido();
        $usuario = new Usuario();
        $pedido->setUsuario_id($identity->id);
        
        $pedido = $pedido->getOneByUser();
        $usuario = $usuario->usuariopedido($identity->id);
        
        $pedido_productos = new Pedido();
        $productos = $pedido_productos->getProductosByPedido($pedido->id);
    }
    require_once 'views/pedido/confirmado.php';
}

public function mis_pedidos(){
    Utils::isIdentity();
    $usuario_id = $_SESSION['identity']->id;
    $pedido = new Pedido();
    
    // Sacar los pedidos del usuario
    $pedido->setUsuario_id($usuario_id);
    $pedidos = $pedido->getAllByUser();
    
    require_once 'views/pedido/mis_pedidos.php';
}

public function detalle(){
    Utils::isIdentity();
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $identity = $_SESSION['identity'];

        // Sacar el pedido
        $pedido = new Pedido();

        $pedido->setUsuario_id($identity->id);
        $usuario = new Usuario();
        $pedido->setId($id);
        $pedido = $pedido->getOne();
        
        // Sacar los poductos
        $pedido_productos = new Pedido();

        $usuario = $usuario->usuariopedido($identity->id);
        
        $productos = $pedido_productos->getProductosByPedido($id);
        
        require_once 'views/pedido/detalle.php';
    }else{
        header('Location:'.'?controller=pedido&action=mis_pedidos');
    }
}

public function gestion(){
    Utils::isAdmin();
    $gestion = true;
    
    $pedido = new Pedido();
    $pedidos = $pedido->getAll();
    
    require_once 'views/pedido/mis_pedidos.php';
}

public function estado(){
    Utils::isAdmin();
    if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
        // Recoger datos form
        $id = $_POST['pedido_id'];
        $estado = $_POST['estado'];
        
        // Upadate del pedido
        $pedido = new Pedido();
        $pedido->setId($id);
        $pedido->setEstado($estado);
        $pedido->edit();
        
        header("Location:".'?controller=pedido&action=detalle&id='.$id);
    }else{
        header("Location:".base_url);
    }
}



}




?>