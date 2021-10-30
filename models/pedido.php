<?php

class Pedido{
	private $id;
	private $usuario_id;
	private $departamento;
	private $municipio;
	private $direccion;
	private $coste;
	private $estado;
	private $fecha;
	private $hora;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getUsuario_id() {
		return $this->usuario_id;
	}

	function getDepartamento() {
		return $this->departamento;
	}

	function getMunicipio() {
		return $this->municipio;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getCoste() {
		return $this->coste;
	}

	function getEstado() {
		return $this->estado;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getHora() {
		return $this->hora;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}

	function setDepartamento($departamento) {
		$this->departamento = $this->db->real_escape_string($departamento);
	}

	function setMunicipio($municipio) {
		$this->municipio = $this->db->real_escape_string($municipio);
	}

	function setDireccion($direccion) {
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	function setCoste($coste) {
		$this->coste = $coste;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setHora($hora) {
		$this->hora = $hora;
	}

    public function getAll(){
		$productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
		return $productos;
	}
	
	public function getOne(){
		$producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
		return $producto->fetch_object();
	}

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()}, '{$this->getDepartamento()}', '{$this->getMunicipio()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

	public function updateStock($id, $unidades){
        $sql = "SELECT stock FROM productos WHERE id = $id";
        $query = $this->db->query($sql);
        $reg = $query->fetch_object()->stock;
        
        $newStock = 0;
        if($reg){
            $newStock = $reg;
        }
        $newStock -= $unidades;

		if($newStock >= 0){
			$sql = "UPDATE productos SET stock = $newStock WHERE id = $id";
        	$this->db->query($sql);
		} else {
			echo "Unidades superan el stock";
		}
        
        
    }

	public function save_linea(){
		$sql = "SELECT LAST_INSERT_ID() as 'pedido';";
		$query = $this->db->query($sql);
		$pedido_id = $query->fetch_object()->pedido;
		
		foreach($_SESSION['carrito'] as $elemento){
			$producto = $elemento['producto'];
			
			$insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
			$this->updateStock($producto->id, $elemento['unidades']);
			$save = $this->db->query($insert);
			
//			var_dump($producto);
//			var_dump($insert);
//			echo $this->db->error;
//			die();
		}
	}
		
    

	public function getAllByUser(){
		$sql = "SELECT p.* FROM pedidos p "
				. "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
			
		$pedido = $this->db->query($sql);
			
		return $pedido;
	}

    public function getOneByUser(){
		$sql = "SELECT p.id, p.coste FROM pedidos p "
				//. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
				. "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
			
		$pedido = $this->db->query($sql);
			
		return $pedido->fetch_object();
	}

    public function getProductosByPedido($id){
        //		$sql = "SELECT * FROM productos WHERE id IN "
        //				. "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";
            
                $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                        . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                        . "WHERE lp.pedido_id={$id}";
                        
                $productos = $this->db->query($sql);
                    
                return $productos;
    }
	
	public function edit(){
		$sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
		$sql .= " WHERE id={$this->getId()};";
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}


	
	

}