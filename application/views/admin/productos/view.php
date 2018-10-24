<img src="<?php echo base_url().'assets/imagenes_productos/'.$producto->imagen?>" alt="<?php echo $producto->nombre?>" style="margin: 10px auto; width: 200px; " class="img-responsive">
<p><strong>Nombre:</strong> <?php echo $producto->nombre;?></p>
<p><strong>Descripcion:</strong> <?php echo $producto->descripcion;?></p>
<p><strong>Estanteria:</strong> <?php echo $producto->estanteria;?></p>
<p><strong>Pasillo:</strong> <?php echo $producto->pasillo;?></p>
<p><strong>Precio:</strong> <?php echo $producto->precio;?></p>
<p><strong>Precio Compra:</strong> <?php echo $producto->precio_compra;?></p>

<p><strong>Stock Minimo:</strong> <?php echo $producto->stock_minimo;?></p>
<p><strong>Stock:</strong> <?php echo $producto->stock;?></p>


<p><strong>Categoria:</strong> <?php echo $producto->categoria;?></p>
<p><strong>Subcategoria:</strong> <?php echo $producto->subcat;?></p>
<?php if (!empty($productosA)): ?>
	
	<table class="table table-bordered">
		<caption class="text-center"><strong>Productos Asociados</strong></caption>
		<thead>
			<tr>
				
				<th>Nombre</th>
				<th>Catnidad</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($productosA as $productoA): ?>
				<tr>
					
					<td><?php echo $productoA->nombre;?></td>
					<td><?php echo $productoA->cantidad;?></td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</table>
<?php endif ?>