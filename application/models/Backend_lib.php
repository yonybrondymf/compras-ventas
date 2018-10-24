<?php

class Backend_lib{
	private $CI;
	public function __construct(){
		$this->CI = & get_instance();
	}

	public function control(){
		if (!$this->CI->session->userdata("login")) {
			redirect(base_url());
		}
		$url = $this->CI->uri->segment(1);
		if ($this->CI->uri->segment(2)) {
			$url = $this->CI->uri->segment(1)."/".$this->CI->uri->segment(2);
		}

		$infomenu = $this->CI->Backend_model->getID($url);

		$permisos = $this->CI->Backend_model->getPermisos($infomenu->id,$this->CI->session->userdata("rol"));
		if ($permisos->read == 0 ) {
			redirect(base_url()."dashboard");
		}else{
			return $permisos;
		}

	}

	
	public function getMenu()
	{
		$menu = '';
		$parents = $this->CI->Backend_model->getParents($this->CI->session->userdata("rol"));
		foreach ($parents as $parent) {
			$children = $this->CI->Backend_model->getChildren($this->CI->session->userdata("rol"),$parent->id);
			$linkParent = $parent->link == '#' ? '#': base_url($parent->link);
			if (!$children) {
				$menu .= '<li>
                        <a href="'.$linkParent.'">
                            <i class="fa fa-home"></i> <span>'.$parent->nombre.'</span>
                        </a>
                    </li>';
			} else {
				$menu .= '<li class="treeview">
	                        <a href="#">
	                            <i class="fa fa-cogs"></i> <span>'.$parent->nombre.'</span>
	                            <span class="pull-right-container">
	                                <i class="fa fa-angle-left pull-right"></i>
	                            </span>
	                        </a><ul class="treeview-menu">';

	            foreach ($children as $child) {
	            	$menu .= '<li><a href="'.base_url($child->link).'"><i class="fa fa-circle-o"></i>'.$child->nombre.'</a></li>';
	                        
	            }
	            $menu .= '</ul></li>';            
			}
		}
		return $menu;
	}


	public function notificaciones(){
		$products = $this->CI->Backend_model->getNotificaciones();
		if (!$products) {
			$total = 0;
		}else{
			$total = count($products); 
		}
		

		$notificaciones = '<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>';

              if ($total > 0) {
              	$notificaciones .= '<span class="label label-danger">'.$total.'</span>';
              }
              

        $notificaciones .= '</a>
            <ul class="dropdown-menu">
              <li class="header">Tienes '.$total.' notificaciones</li>';
              if (!empty($products)) {
              	$notificaciones .= '<li>
                <ul class="menu menu-notificaciones">';
                	foreach ($products as $producto){
                          $notificaciones .= '<li>';

                          	$notificaciones .= '<span class="pull-right" style="margin-left:5px;">
                          	<a href="'.$producto->id.'" class="remove-notificacion"><i class="fa fa-times"></i></a></span>';		
                            
                             $notificaciones .='<i class="fa fa-warning text-red"></i> El producto <b>'.$producto->nombre.'</b> llego a su stock minimo de '. $producto->stock_minimo;
                            
                          $notificaciones.='</li>';
                      }
                $notificaciones .= '</ul>
              </li>';

              }
              
              
               	if (!empty($products)){
	                 $notificaciones .= '<li class="footer"><a href="'.base_url().'mantenimiento/productos">Ver Productos</a></li>';
	             }
              $notificaciones .= '</ul></li>';
        
        return $notificaciones;
	}
}