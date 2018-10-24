<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	private $permisos;
	private $modulo = "Productos";

	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Productos_model");
		$this->load->model("Categorias_model");
		$this->load->model("Ventas_model");
		$this->load->model("Subcategorias_model");
		$this->load->model("Presentacion_model");
		$this->load->model("Marcas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'productos' => $this->Productos_model->getProductos(),
			'productoslast' => $this->Productos_model->getLastProductos()
		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/list",$data);
		$this->load->view("layouts/footer");

	}
	public function add(){
		
		$data =array( 
			"categorias" => $this->Categorias_model->getCategorias(),
			"subcategorias" => $this->Subcategorias_model->getSubcategorias(),
			"productos" => $this->Productos_model->getProductos(),
			"presentaciones" => $this->Presentacion_model->getPresentaciones(),
			"marcas" => $this->Marcas_model->getMarcas(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){

		$codigo_barras = $this->input->post("codigo_barras");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");
		$precio = $this->input->post("precio");
		$precio_compra = $this->input->post("precio_compra");
		$presentacion = $this->input->post("presentacion");
		$marca = $this->input->post("marca");
		$estanteria = $this->input->post("estanteria");
		$pasillo = $this->input->post("pasillo");
		$categoria = $this->input->post("categoria");
		$subcategoria = $this->input->post("subcategoria");
		$stockminimo = $this->input->post("stockminimo");
	
		//productos Asociados
		$idproductosA = $this->input->post("idproductosA");
		$cantidadA = $this->input->post("cantidadA");

		$this->form_validation->set_rules("codigo_barras","Codigo de Barra","required|is_unique[productos.codigo_barras]");
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio","Precio","required");


		if ($this->form_validation->run()) {
			$imagen = '';
			$config['upload_path']          = './assets/imagenes_productos/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('imagen'))
            {
                $this->session->set_flashdata("error","No se pudo guardar la informacion");

                redirect(base_url()."mantenimiento/productos/add");
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());

                $imagen = $data['upload_data']['file_name'];
            }
			$data  = array(
				'codigo_barras' => $codigo_barras,
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'precio' => $precio,
				'precio_compra' => $precio_compra,
				'estanteria' => $estanteria,
				'pasillo' => $pasillo,
				'categoria_id' => $categoria,
				"subcategoria_id" => $subcategoria,
				"marca_id" => $marca,
				"presentacion_id" => $presentacion,
				'estado' => "1",
				'stock_minimo' => $stockminimo,
				'imagen' => $imagen
			);
			$producto_id = $this->Productos_model->save($data);
			if ($producto_id != false) {
				$this->generateBarCode($codigo_barras);

				if (!empty($idproductosA)) {
					//Guardar productos Asociados
					for($i = 0; $i < count($idproductosA); $i++){
						$dataA = array(
							"producto_id" => $producto_id,
							"producto_asociado" => $idproductosA[$i],
							"cantidad" => $cantidadA[$i]
						);

						$this->Productos_model->saveAsociados($dataA);
					}
				}
				$this->backend_lib->savelog($this->modulo,"Inserción de un nuevo producto con codigo de barras ".$codigo_barras);
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/add");
			}
		}
		else{
			$this->add();
		}

		
	}

	public function edit($id){
		$data =array( 
			"producto" => $this->Productos_model->getProducto($id),
			"productosAsociados" => $this->Productos_model->getProductosA($id),
			"categorias" => $this->Categorias_model->getCategorias(),
			"subcategorias" => $this->Subcategorias_model->getSubcategorias(),
			"presentaciones" => $this->Presentacion_model->getPresentaciones(),
			"marcas" => $this->Marcas_model->getMarcas(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idproducto = $this->input->post("idProducto");
		$codigo_barras = $this->input->post("codigo_barras");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");
		$precio = $this->input->post("precio");
		$precio_compra = $this->input->post("precio_compra");
		$presentacion = $this->input->post("presentacion");
		$marca = $this->input->post("marca");
		$estanteria = $this->input->post("estanteria");
		$pasillo = $this->input->post("pasillo");
		$categoria = $this->input->post("categoria");
		$subcategoria = $this->input->post("subcategoria");
		$stockminimo = $this->input->post("stockminimo");
		$imagen_actual = $this->input->post("imagen_actual");
		//productos Asociados
		$idproductosA = $this->input->post("idproductosA");
		$cantidadA = $this->input->post("cantidadA");

		$productoActual = $this->Productos_model->getProducto($idproducto);

		if ($codigo_barras == $productoActual->codigo_barras) {
			$is_unique = '';
		}
		else{
			$is_unique = '|is_unique[productos.codigo_barras]';
		}

		$this->form_validation->set_rules("codigo_barras","Codigo de Barra","required".$is_unique);
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio","Precio","required");
		

		if ($this->form_validation->run()) {

			if (!empty($_FILES['imagen']['name'])) {
				$config['upload_path']          = './assets/imagenes_productos/';
	            $config['allowed_types']        = 'gif|jpg|png';

	            $this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('imagen'))
	            {
	                $imagen_nueva = $imagen_actual;  
	            }
	            else
	            {
	                $data = array('upload_data' => $this->upload->data());

	                $imagen_nueva = $data['upload_data']['file_name'];
	            }
			}else{
				$imagen_nueva = $imagen_actual;
			}
			$data  = array(
				'codigo_barras' => $codigo_barras,
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'precio' => $precio,
				'precio_compra' => $precio_compra,
				'estanteria' => $estanteria,
				'pasillo' => $pasillo,
				'categoria_id' => $categoria,
				"subcategoria_id" => $subcategoria,
				"marca_id" => $marca,
				"presentacion_id" => $presentacion,
				'estado' => "1",
				'stock_minimo' => $stockminimo,
				'imagen' => $imagen_nueva
			);
			if ($this->Productos_model->update($idproducto,$data)) {

				$this->generateBarCode($codigo_barras);
				$this->Productos_model->deleteProductosAsociados($idproducto);

				if (!empty($idproductosA)) {
					//Guardar productos Asociados
					for($i = 0; $i < count($idproductosA); $i++){
						$dataA = array(
							"producto_id" => $idproducto,
							"producto_asociado" => $idproductosA[$i],
							"cantidad" => $cantidadA[$i]
						);

						$this->Productos_model->saveAsociados($dataA);
					}
				}
				$this->backend_lib->savelog($this->modulo,"Actualización del Producto con codigo de barra ".$codigo_barras);
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/edit/".$idproducto);
			}
		}else{
			$this->edit($idproducto);
		}

		
	}
	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$producto = $this->Productos_model->getProducto($id);
		$this->Productos_model->update($id,$data);
		$this->backend_lib->savelog($this->modulo,"Eliminación del  Producto con codigo de barra ".$producto->codigo_barras);
		echo "mantenimiento/productos";
	}

	public function view($id){
		$data  = array(
			'producto' => $this->Productos_model->getProducto($id), 
			'productosA' => $this->Productos_model->getProductosA($id), 

		);
		$this->load->view("admin/productos/view",$data);
	}

	protected function generateBarCode($codigo_barras){
		$this->load->library('zend');
	   	$this->zend->load('Zend/Barcode');
	   	$file = Zend_Barcode::draw('code128', 'image', array('text' => $codigo_barras), array());
	   	//$code = time().$code;
	   	$store_image = imagepng($file,"./assets/barcode/{$codigo_barras}.png");
	}

}