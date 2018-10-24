<div class="contenido">
	<div class="form-group text-center">
		<label for="">Quicheladas</label><br>
		<p>
		<img src="<?php echo base_url();?>img/quicheladas.png" height="64" width="64"> 
		</p>
		3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco
		Santa Cruz del Quiche
	</div>
	<div class="form-group text-center">
		<label for=""><?php echo $venta->tipocomprobante;?></label><br>
		<?php echo $venta->serie ." - ".$venta->num_documento;?>
	</div>
	<div class="form-group">
		<p><b>Estado: </b><?php if ($venta->estado == "1") {
                                                    echo '<span class="label label-success">Pagado</span>';
                                                }else if($venta->estado == "2"){
                                                    echo '<span class="label label-warning">Pendiente</span>';
                                                }else{
                                                    echo '<span class="label label-danger">Anulado</span>';
                                                } ?>
                                            </p>
		<p><b>Cliente: </b><?php echo $venta->nombre;?></p>
		<p><b>No. Documento: </b><?php echo $venta->documento;?></p>
		<p><b>Fecha: </b><?php echo $venta->fecha;?></p>
	</div>

	<div class="form-group">
		<table width="100%" cellpadding="10" cellspacing="0" border="0">
			<thead>
				<tr>
					<th>Cant.</th>
					<th>Producto</th>
					<th style="text-align: right;">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<tr>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->nombre;?></td>
					<td style="text-align: right;"><?php echo $detalle->importe;?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">Subtotal:</td>
					<td style="text-align: right;"><?php echo $venta->subtotal;?></td>
				</tr>
				<!--
				<tr>
					<td colspan="2">iva:</td>
					<td style="text-align: right;">?php echo $venta->iva;?></td>
				</tr>
			-->
				<tr>
					<td colspan="2">Descuento:</td>
					<td style="text-align: right;"><?php echo $venta->descuento;?></td>
				</tr>
				<tr>
					<th colspan="2">TOTAL:</th>
					<th style="text-align: right;"><?php echo $venta->total;?></th>
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