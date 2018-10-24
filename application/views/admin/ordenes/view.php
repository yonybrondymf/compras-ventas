<?php 
    $nummesas = "";
    foreach ($mesas as $mesa){
        $nummesas .= $mesa->numero.","; 
    } 

?>
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
        <b>Mesas: </b> <?php echo substr($nummesas, 0, -1); ?><br></div>
    <div class="form-group">
        <table width="100%" cellpadding="10" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th style="text-align: left;">Precio</th>
                    <th style="text-align: right;"> Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0;?>
                <?php foreach($productos as $producto):?>
                <tr>
                    <td>
                        <?php echo $producto->nombre;?>
                    </td>

                    <td>
                        <?php echo $producto->cantidad;?>
                    </td>
                    <td style="text-align: left;">
                        <?php echo number_format($producto->precio, 2, '.', '');?>
                    </td>

                    <td style="text-align: right;">
                        <?php echo number_format($producto->cantidad * $producto->precio, 2, '.', ''); ?>
                    </td>

                        <?php $total = $total + ($producto->cantidad * $producto->precio);?>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">TOTAL:</th>
                    <th style="text-align: right;"><?php echo number_format($total, 2, '.', '');?></th>
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