<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if ($this->backend_lib->verGrafico()): ?>
    <section class="content-header">
        <h1>
        Dashboard
        <small>Panel de Control </small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $cantClientes;?></h3>

                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="<?php echo base_url();?>mantenimiento/clientes" class="small-box-footer">Ver Clientes <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $cantProductos;?></h3>

                        <p>Productos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?php echo base_url();?>mantenimiento/productos" class="small-box-footer">Ver Productos <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $cantUsuarios;?></h3>

                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo base_url();?>administrador/usuarios" class="small-box-footer">Ver Usuarios <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $cantVentas;?></h3>

                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo base_url();?>movimientos/ventas" class="small-box-footer">Ver Ventas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Grafico de Ventas x Día</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Grafico de Ventas x Meses</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div id="grafico" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
                        </div>
                          <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div id="graficoMeses" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
                        </div>
                          <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
  
        <div class="row">
            <div class="col-md-6">
                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Productos mas vendidos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Codigo de Barra</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productosmvendidos as $pmv): ?>
                                    <tr>
                                        <td><?php echo $pmv->codigo_barras;?></td>
                                        <td><?php echo $pmv->nombre;?></td>
                                        <td><?php echo $pmv->totalVendidos;?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="<?php echo base_url();?>mantenimiento/productos" class="uppercase">Ver Todos los productos</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                  <!-- /.box -->
            </div>
            <div class="col-md-6">
                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Productos Recientemente Agregados</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <?php foreach ($productoslast as $pl): ?>
                                <li class="item">
                                    <div class="product-img">
                                        <img src="<?php echo base_url();?>assets/imagenes_productos/<?php echo $pl->imagen?>" alt="<?php  echo $pl->nombre;?>">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title"><?php  echo $pl->nombre;?>
                                            <span class="label label-warning pull-right"><?php  echo $pl->precio;?></span>
                                        </a>
                                        <span class="product-description">
                                          <?php  echo $pl->descripcion;?>
                                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                            <?php endforeach ?>
                            
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="<?php echo base_url();?>mantenimiento/productos" class="uppercase">Ver Todos los productos</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                  <!-- /.box -->
            </div>
        </div>
        
    </section>
    <!-- /.content -->
<?php endif?>
</div>
        