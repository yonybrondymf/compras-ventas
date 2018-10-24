<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <table border="1" width="100%">
                <tbody>
                    <tr>
                        <th colspan="4" class="text-center">Informacion del Cliente</th>
                    </tr>
                    <tr>
                        <th>Cliente:</th>
                        <td colspan="3"><?php echo $venta->nombre;?></td>
                    </tr>
                    <tr>
                    	<th>Tipo Documento:</th>
                    	<td><?php echo $venta->tipocomprobante;?></td>
                    	<th>Nro. Documento:</th>
                    	<td><?php echo $venta->documento;?></td>
                    </tr>
                    <tr>
                    	<th>Direccion:</th>
                    	<td><?php echo $venta->direccion;?></td>
                    	<th>Telefono:</th>
                    	<td><?php echo $venta->telefono;?></td>
                    </tr>
                    
                </tbody>
            </table>
            <br>
            <table border="1" width="100%">
                <tbody>
                    <tr>
                        <th colspan="4" class="text-center">Detalle de la Venta</th>
                    </tr>
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Importe</th>
                    </tr>
                    <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td><?php echo $detalle->cantidad;?></td>
                            <td><?php echo $detalle->nombre;?></td>
                            <td><?php echo $detalle->precio;?></td>
                            <td><?php echo $detalle->importe;?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <th colspan="3" class="text-right">Subtotal:</th>
                        <td><?php echo $venta->subtotal; ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">IVA:</th>
                        <td><?php echo $venta->iva; ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Descuento:</th>
                        <td><?php echo $venta->descuento; ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Total:</th>
                        <td><?php echo $venta->total; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>