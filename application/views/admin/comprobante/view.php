<p><strong>Nombre:</strong> <?php echo $comprobante->nombre; ?></p>
<p><strong>IVA:</strong> <?php echo $comprobante->iva; ?></p>
<p><strong>Serie:</strong> <?php echo $comprobante->serie; ?></p>
<p><strong>Fecha de Registro:</strong> <?php echo $comprobante->fecha_registro; ?></p>
<p><strong>N° Inicial:</strong> <?php echo $comprobante->no_inicial; ?></p>
<p><strong>N° Final:</strong> <?php echo $comprobante->no_final; ?></p>
<p><strong>Resolución::</strong> <?php echo $comprobante->resolucion; ?></p>
<p><strong>Fecha Resolución:</strong> <?php echo $comprobante->fecha_resolucion; ?></p>
<p><strong>Predeterminado:</strong> <?php echo $comprobante->predeterminado == 1 ? 'SI':'NO'; ?></p>