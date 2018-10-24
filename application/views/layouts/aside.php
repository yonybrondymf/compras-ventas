        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar" id="side-bar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">      
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">

                    <li class="header">Menu</li>
                          <!-- Sidebar user panel -->
                        <div class="user-panel">
                            <div class="pull-left image">
                             <img src="<?php echo base_url();?>img/cloud.png" alt="Avatar" /> 
                            </div>
                            <div class="pull-left info">
                          <p><?php echo $this->session->userdata("nombre")?></p>
                          <p><i class="fa fa-circle text-success"></i> En Linea</p>
                        </div>
                      </div>

                    <?php echo $this->backend_lib->getMenu();?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->
        <?php if ($this->backend_lib->saveInventario()): ?>
            <script>
                swal({
                    title: "Inventario Inicial Registrado",
                    text: "Se ha registrado el inventario inicial del mes actual",
                    timer: 5000,
                    showConfirmButton: false,
                    type: 'success'
                });
            </script>
        <?php endif ?>