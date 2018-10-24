<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		//I'm just using rand() function for data example
		$temp = rand(10000, 99999);
		$this->set_barcode($temp);
	}
	
	private function set_barcode2($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}

	function set_barcode($code)
	{
	   $this->load->library('zend');
	   $this->zend->load('Zend/Barcode');
	   $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
	   //$code = time().$code;
	   $store_image = imagepng($file,"./assets/barcode/{$code}.png");
	   echo  $code.'.png';
	}

}
