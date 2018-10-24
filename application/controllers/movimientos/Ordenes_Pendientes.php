<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_Pendientes extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Ordenes_model");
		$this->load->model("Ventas_model");
		$this->load->model("Categorias_model");
		$this->load->model("Mesas_model");
		$this->load->model("Clientes_model");
		$this->load->model("Productos_model");
		$this->load->model("Permisos_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'ordenes' => $this->Ordenes_model->getOrdenesPendientes(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes_pendientes/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){
		$data  = array(
			'categorias' => $this->Categorias_model->getCategorias(), 
			'mesas' => $this->Mesas_model->getMesas(1), 

		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){

		$mesas = $this->input->post("mesas");
		$productos = $this->input->post("productos");
		$cantidades = $this->input->post("cantidades");

		$dataPedido = array(
			"fecha" => date("Y-m-d"),
			"usuario_id" => $this->session->userdata("id"),
			"estado" => 1
		);

		$pedido_id = $this->Ordenes_model->save($dataPedido);

		if ($pedido_id != false) {
			for($i = 0; $i < count($mesas);$i++){
				$dataMesas = array(
					"estado" => 0
				);
				$dataPedidoMesas = array(
					"pedido_id" => $pedido_id,
					"mesa_id" => $mesas[$i],
				);
				$this->Ordenes_model->updateMesa($mesas[$i],$dataMesas);
				$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			}

			for ($i=0; $i < count($productos) ; $i++) { 
				$dataPedidoProductos = array(
					"pedido_id" => $pedido_id,
					"producto_id" => $productos[$i],
					"cantidad" => $cantidades[$i]
				);

				$this->Ordenes_model->savePedidoProductos($dataPedidoProductos);

				$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->condicion == "1") {
					$this->updateProducto($productos[$i],$cantidades[$i]);
					$productoActual = $this->Productos_model->getProducto($productos[$i]);
					if ($productoActual->stock <= $productoActual->stock_minimo) {
						$data = array(
							'estado' => 0,
							'producto_id' => $productos[$i] 
						);
						$this->Ventas_model->saveNotificacion($data);
					}
				}
				$this->updateProductosAsociados($productos[$i],$cantidades[$i]);
			}
			$dataP  = array(
				'mesas' => $this->Ordenes_model->getPedidosMesas($pedido_id),
				/*'productos' => $this->Ordenes_model->getPedidosProductos($pedido_id),*/
				'subcatproductos' => $this->Ordenes_model->subcategorias($pedido_id,1) 
			);
			$this->load->view("admin/ordenes/view3",$dataP);
		}else{
			redirect(base_url()."movimientos/ordenes/add");
		}
		
	}

	protected function updateProducto($idproducto,$cantidad){
		$productoActual = $this->Productos_model->getProducto($idproducto);
		$data = array(
			'stock' => $productoActual->stock - $cantidad, 
		);
		$this->Productos_model->update($idproducto,$data);
	}

	protected function updateProductosAsociados($idproducto,$cantidad){
		$productosA = $this->Productos_model->getProductosA($idproducto);
		if (!empty($productosA)) {
			foreach ($productosA as $productoA) {
				$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

				if ($productoActual->condicion != 0) {
					$this->updateProducto($productoA->producto_asociado,($productoA->cantidad * $cantidad));
				}
				
			}
		}
	}

	public function edit($id){
		$data  = array(
			'orden' => $this->Ordenes_model->getPedido($id), 
			'categorias' => $this->Categorias_model->getCategorias(), 
			'mesas' => $this->Mesas_model->getMesas(1), 
			'productos' => $this->Ordenes_model->getPedidosProductos($id),
			'pedidomesas' => $this->Ordenes_model->getPedidosMesas($id)
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idPedido = $this->input->post("idPedido");
		$cantidades = $this->input->post("cantidades");
		$productos = $this->input->post("productos");
		$mesa = $this->input->post("mesa");
		$nuevamesa = $this->input->post("nuevamesa");

		if (!empty($mesa)) {
			$dataPedidoMesas = array(
				'pedido_id' => $idPedido,
				'mesa_id' => $mesa 
			);
			$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			$dataMesas = array(
				"estado" => 0
			);
			$this->Ordenes_model->updateMesa($mesa,$dataMesas);
		}

		if (!empty($nuevamesa)) {
			$mesas = $this->Ordenes_model->getPedidosMesas($idPedido);
			$this->Ordenes_model->deletePedidoMesas($idPedido);
			foreach ($mesas as $m) {
				$dataMesas = array(
					"estado" => 1
				);
				$this->Ordenes_model->updateMesa($m->id,$dataMesas);
			}

			$dataPedidoMesas = array(
				'pedido_id' => $idPedido,
				'mesa_id' => $nuevamesa 
			);
			$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			$dataMesas = array(
				"estado" => 0
			);
			$this->Ordenes_model->updateMesa($nuevamesa,$dataMesas);

		}
		$data  = array(
			'updated' => 2, 
		);
		$this->Ordenes_model->setUpdated($idPedido,$data);

		for ($i=0; $i < count($productos) ; $i++) { 
			$infoproducto = $this->Productos_model->getProducto($productos[$i]);

            $dataProducto = array(
                'stock' => $infoproducto->stock - $cantidades[$i], 
            );

            if ($infoproducto->condicion == "1") {
            	$this->Productos_model->update($productos[$i],$dataProducto);
            	$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->stock <= $productoActual->stock_minimo) {
					$data = array(
						'estado' => 0,
						'producto_id' => $productos[$i] 
					);
					$this->Ventas_model->saveNotificacion($data);
				}
            }


            $dataDetalle  = array(
                'pedido_id'     => $idPedido, 
                'producto_id'     => $productos[$i],
                'cantidad' => $cantidades[$i],
                'estado' => 0
            );

            $this->Ordenes_model->savePedidoProductos($dataDetalle);
            $this->updateProductosAsociados($productos[$i],$cantidades[$i]);

		}

		$dataP  = array(
			'mesas' => $this->Ordenes_model->getPedidosMesas($idPedido),
			
			'subcatproductos' => $this->Ordenes_model->subcategorias($idPedido,1)
		);
		$this->load->view("admin/ordenes/view3",$dataP);







		//agregar mesas al pedido
		/*$dataPedidoMesas = array(
			'pedido_id' => $idPedido,
			'mesa_id' => $mesa 
		);
		if ($this->Ordenes_model->savePedidoMesa($dataPedidoMesas)) {
			$dataMesas = array(
				"estado" => 0
			);
			$this->Ordenes_model->updateMesa($mesa,$dataMesas);

			for ($i=0; $i < count($productos) ; $i++) { 
				$infoproducto = $this->Productos_model->getProducto($productos[$i]);

                $dataProducto = array(
                    'stock' => $infoproducto->stock - $cantidades[$i], 
                );

                if ($infoproducto->condicion == "1") {
                	$this->Productos_model->update($productos[$i],$dataProducto);
                	$productoActual = $this->Productos_model->getProducto($productos[$i]);
					if ($productoActual->stock <= $productoActual->stock_minimo) {
						$data = array(
							'estado' => 0,
							'producto_id' => $productos[$i] 
						);
						$this->Ventas_model->saveNotificacion($data);
					}
	            }


                $dataDetalle  = array(
                    'pedido_id'     => $idPedido, 
                    'producto_id'     => $productos[$i],
                    'cantidad' => $cantidades[$i],
                    'estado' => 0
                );

                $this->Ordenes_model->savePedidoProductos($dataDetalle);
                $this->updateProductosAsociados($productos[$i],$cantidades[$i]);

			}

			$dataP  = array(
				'mesas' => $this->Ordenes_model->getPedidosMesas($idPedido),
				'productos' => $this->Ordenes_model->getPedidosProductos($idPedido), 
			);
			$this->load->view("admin/ordenes/view",$dataP);

		}else{
			redirect(base_url()."movimientos/ordenes/edit/".$idPedido);
		}*/


		
	}

	protected function save_detalle($productos,$idventa,$precios,$cantidades,$importes){
		for ($i=0; $i < count($productos); $i++) { 
			$data  = array(
				'producto_id' => $productos[$i], 
				'venta_id' => $idventa,
				'precio' => $precios[$i],
				'cantidad' => $cantidades[$i],
				'importe'=> $importes[$i],
			);

			$this->Ventas_model->save_detalle($data);
			$productoActual = $this->Productos_model->getProducto($productos[$i]);
			if ($productoActual->condicion == "1") {
				$this->updateProducto($productos[$i],$cantidades[$i]);
				$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->stock <= $productoActual->stock_minimo) {
					$data = array(
						'estado' => 0,
						'producto_id' => $productos[$i] 
					);
					$this->Ventas_model->saveNotificacion($data);
				}
			}

			$this->updateProductosAsociados($productos[$i]);
		}
	}


	public function pay($id){
		$data  = array(
			'orden' => $this->Ordenes_model->getPedido($id),
			'productos' => $this->Ordenes_model->getPedidosProductos($id),
			"clientes" => $this->Clientes_model->getSoloClientes(),
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"comprobantePredeterminado" => $this->Ordenes_model->comprobantePredeterminado()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/pay",$data);
		$this->load->view("layouts/footer");
	}

	/*public function view(){
		$id = $this->input->post("idpedido");
		$data  = array(
			'mesas' => $this->Ordenes_model->getPedidosMesas($id),
			'productos' => $this->Ordenes_model->getPedidosProductos($id), 
		);
		$this->load->view("admin/ordenes/view",$data);
	}*/
	public function view(){
		$id = $this->input->post("idpedido");
		$data  = array(
			'mesas' => $this->Ordenes_model->getPedidosMesas($id),
			'subcatproductos' => $this->Ordenes_model->subcategorias($id), 
		);
		$this->load->view("admin/ordenes/view3",$data);
	}

	public function delete($id){

		$mesas = $this->Ordenes_model->getPedidosMesas($id);

		foreach ($mesas as $m) {
			$data = array(
				"estado" => 1
			);
			$this->Mesas_model->update($m->id,$data);
		}

		$this->Ordenes_model->deletePedidoMesas($id);

		$detalles = $this->Ordenes_model->getPedidosProductos($id);


        foreach ($detalles as $detalle) {
            $infoproducto = $this->Productos_model->getProducto($detalle->producto_id);
            $productosA = $this->Productos_model->getProductosA($detalle->producto_id);
            if (!empty($productosA)) {
				foreach ($productosA as $productoA) {
					$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

					if ($productoActual->condicion != 0) {

						$data = array(
							"stock" => $productoActual->stock + ($detalle->cantidad * $productoA->cantidad)
						);
						$this->Productos_model->update($productoA->producto_asociado,$data);
					}
					
				}
			}

            $dataProducto = array(
                'stock' => $infoproducto->stock + $detalle->cantidad, 
            );

            $this->Productos_model->update($detalle->producto_id,$dataProducto);
        }
        $this->Ordenes_model->deletePedidoProductos($id);
        $this->Ordenes_model->deletePedido($id);
        
    
        echo "movimientos/ordenes";
	}

	public function getProductosByCategoria(){
		$idcategoria = $this->input->post("idcategoria");
		$productos = $this->Ordenes_model->getProductosByCategoria($idcategoria);
		echo json_encode($productos);
	}

	public function infoComprobante(){
		$id = $this->input->post("idcomprobante");
		$comprobante = $this->Ventas_model->getComprobante($id);
		echo json_encode($comprobante);
	}

	public function deleteProductoOrden(){
		$idorden = $this->input->post("idorden");
		$idprod = $this->input->post("idprod");
		$cantidad = $this->input->post("cantidad");

		if($this->Ordenes_model->deleteProductoOrden($idorden,$idprod)){
			$infoproductoA = $this->Productos_model->getProducto($idprod);
			if ($infoproductoA->condicion == 1) {
				$dataStock = array(
					"stock" => $infoproductoA->stock + $cantidad
				);

				$this->Productos_model->update($idprod,$dataStock);
			}

			$productosA = $this->Productos_model->getProductosA($idprod);
			if (!empty($productosA)) {
				foreach ($productosA as $productoA) {
					$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

					if ($productoActual->condicion != 0) {

						$data = array(
							"stock" => $productoActual->stock + ($productoA->cantidad * $cantidad)
						);
						$this->Productos_model->update($productoActual->id,$data);
					}
					
				}
			}
			echo "1";
		} else {
			echo "0";
		}
	}

	public function checkClave(){
		$clave = $this->input->post("clave");
		$idorden = $this->input->post("idOrden");
		$idprod = $this->input->post("idProducto");
		$cantidad = $this->input->post("cantidad");

		$resultados = $this->Permisos_model->checkClave($clave);

		if ($resultados) {
			//echo "1";
			if($this->Ordenes_model->deleteProductoOrden($idorden,$idprod)){
			$infoproductoA = $this->Productos_model->getProducto($idprod);
			if ($infoproductoA->condicion == 1) {
				$dataStock = array(
					"stock" => $infoproductoA->stock + $cantidad
				);

				$this->Productos_model->update($idprod,$dataStock);
			}

			$productosA = $this->Productos_model->getProductosA($idprod);
			if (!empty($productosA)) {
				foreach ($productosA as $productoA) {
					$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

					if ($productoActual->condicion != 0) {

						$data = array(
							"stock" => $productoActual->stock + ($productoA->cantidad * $cantidad)
						);
						$this->Productos_model->update($productoActual->id,$data);
					}
					
				}
			}
			echo "1";
		}
		}else{
			echo "0";
		}
	}
}
