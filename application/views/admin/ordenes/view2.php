<?php 
    $nummesas = "";
    foreach ($mesas as $mesa){
        $nummesas .= $mesa->numero.","; 
    } 

?>
<div class="row">
	<div class="col-xs-12 text-center">
		<b>Quicheladas</b><br>
		3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco <br>
		Santa Cruz del Quiche <br>
		
	</div>
</div> <br>
<div class="row">
	<div class="col-xs-6">	
		<b>Mesas: </b> <?php echo substr($nummesas, 0, -1); ?><br>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php $total = 0;?>
				<?php foreach($productos as $producto):?>
				<tr>
					<td><?php echo $producto->nombre;?></td>
					<td><?php echo $producto->cantidad;?></td>
					<td><?php echo number_format($producto->precio, 2, '.', '');?></td>
					<td><?php echo number_format($producto->cantidad * $producto->precio, 2, '.', ''); ?>
					</td>
					<?php $total = $total + ($producto->cantidad * $producto->precio);?>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><?php echo number_format($total, 2, '.', '');?></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="form-group text-center">
        <p>Gracias por tu preferencia!!!</p>
        <p>Si el servicio fue de tu agrado te agradeceremos una <strong>Propina</strong></p>
        <p>Recuerda visitarnos en:</p>
        <p><i class="fa fa-globe"> www.quicheladas.com</i></p>
        <p><i class="fa fa-facebook-square"> Quicheladas y Ceviches</i></p>
    </div>
</div>