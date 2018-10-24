$(document).ready(function () {
    $('.select2').select2();
    //new code - Compra

    $(document).on("click",".btn-view-barcode", function(){
        codigo_barra = $(this).val();
        cantidad = $(this).closest("tr").find("td:eq(9)").text();
        html = "<div class='row'>";
        for (var i = 1; i <= Number(cantidad); i++) {
            html += "<div class='col-xs-6'>";
            html += "<svg id='barcode"+i+"'></svg>";
            html += "</div>";
        }
        html += "</div>";
        $("#modal-barcode .modal-body").html(html);
        for (var i = 1; i <= Number(cantidad); i++) {
            JsBarcode("#barcode"+i, codigo_barra, {
              
              displayValue: true
            });
        }
    });

    $(".btn-info-compra").on("click", function(){
        idCompra = $(this).val();
        $.ajax({
            url:base_url + "movimientos/compras/view",
            type: "POST",
            data: {id:idCompra},
            success:function(resp){
                $("#modal-compra .modal-body").html(resp);
            }
        });
    });
    $(".btn-info-venta").on("click", function(){
        idVenta = $(this).val();
        $.ajax({
            url:base_url + "movimientos/ventas/view",
            type: "POST",
            data: {id:idVenta},
            success:function(resp){
                $("#modal-venta .modal-body").html(resp);
            }
        });
    });
    $("#codigo_barras").keypress(function(event){
        if (event.which == '10' || event.which == '13') {
            event.preventDefault();
        }
    });
    $('#searchProductoVenta').keypress(function(event){
        codigo_barra = $(this).val();

        if (event.which == '10' || event.which == '13') {
            
            
            $.ajax({
                url: base_url+"movimientos/ventas/getProductoByCode",
                type: "POST",
                dataType:"json",
                data:{ codigo_barra: codigo_barra},
                success:function(data){
                
                    if (data =="0") {
                        swal({
                            position: 'center',
                            type: 'warning',
                            title: 'El codigo de barra no esta registrado o no cuenta con stock disponible',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }else{
                        html = "<tr>";
                        html +="<td><input type='hidden' name='idproductos[]' value='"+data.id+"'>"+data.codigo_barras+"</td>";
                        html +="<td>"+data.nombre+"</td>";
                        html +="<td>"+data.marca+"</td>";
                        html +="<td><input type='hidden' name='precios[]' value='"+data.precio+"'>"+data.precio+"</td>";
                        html +="<td>"+data.stock+"</td>";
                        html +="<td><input type='text' name='cantidades[]' class='cantidadesVenta' value='1' onkeypress='validate(event)'></td>";
                        html +="<td><input type='hidden' name='importes[]' value='"+data.precio+"'><p>"+data.precio+"</p></td>";
                        html +="<td><button type='button' class='btn btn-danger btn-remove-producto-compra'><span class='fa fa-times'></span></button></td>";
                        html +="</tr>"

                        $("#tbventas tbody").append(html);
                        sumarVenta();
                    }
                    
                }
            });
            $('#searchProductoVenta').val(null);
            event.preventDefault();
        }
    });
    $('#searchProductoCompra').keypress(function(event){
        codigo_barra = $(this).val();

        if (event.which == '10' || event.which == '13') {
            
            
            $.ajax({
                url: base_url+"movimientos/compras/getProductoByCode",
                type: "POST",
                dataType:"json",
                data:{ codigo_barra: codigo_barra},
                success:function(data){
                
                    if (data =="0") {
                        swal({
                            position: 'center',
                            type: 'warning',
                            title: 'El codigo de barra no esta registrado o no cuenta con stock disponible',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }else{
                        html = "<tr>";
                        html +="<td><input type='hidden' name='idproductos[]' value='"+data.id+"'>"+data.codigo_barras+"</td>";
                        html +="<td>"+data.nombre+"</td>";
                        html +="<td>"+data.marca+"</td>";
                        html +="<td><input type='hidden' name='precios[]' value='"+data.precio_compra+"'>"+data.precio_compra+"</td>";
                        html +="<td><input type='text' name='cantidades[]' class='cantidadesCompra' value='1'></td>";
                        html +="<td><input type='hidden' name='importes[]' value='"+data.precio_compra+"'><p>"+data.precio_compra+"</p></td>";
                        html +="<td><button type='button' class='btn btn-danger btn-remove-producto-compra'><span class='fa fa-times'></span></button></td>";
                        html +="</tr>"

                        $("#tbcompras tbody").append(html);
                        sumarCompra();
                    }
                    
                }
            });
            $('#searchProductoCompra').val(null);
            event.preventDefault();
        }
    });
    $(document).on("click",".btn-remove-producto-compra", function(){
        modulo = $("#modulo").val();
        if (modulo == "ventas") {
            $(this).closest("tr").remove();
            sumarVenta();
        }else{
            $(this).closest("tr").remove();
            sumarCompra();
        }
        
    });

    $("#comprobante").on("change", function(){
        optionSelected = $(this).val();
        infoOptionSelected = optionSelected.split("*");
        if (optionSelected == '') {
            $("#comprobante_id").val(null);
            $("#iva").val(0);
        }else{
            $("#comprobante_id").val(infoOptionSelected[0]);
            $("#iva").val(infoOptionSelected[2]);
        }
        sumarCompra();
    });

    function sumarCompra(){
        subtotal = 0;
        $("#tbcompras tbody tr").each(function(){
            subtotal = subtotal + Number($(this).children("td:eq(5)").find('input').val());
        });

        $("input[name=subtotal]").val(subtotal.toFixed(2));

        $("input[name=total]").val(subtotal.toFixed(2));
    }
    $(document).on("keyup mouseup","#tbcompras input.cantidadesCompra", function(){
        cantidad = Number($(this).val());
        precio = Number($(this).closest("tr").find("td:eq(3)").text());
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
        sumarCompra();
    });
    $(document).on("keyup mouseup","#tbventas input.cantidadesVenta", function(){
        cantidad = Number($(this).val());
        precio = Number($(this).closest("tr").find("td:eq(3)").text());
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(6)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(6)").children("input").val(importe.toFixed(2));
        sumarVenta();  
    });

    $("#btn-guardar-compra").on("click", function(){
        cantidadproductos = Number($("#tbcompras tbody tr").length);
        if (cantidadproductos == 0) {
            swal({
                    position: 'center',
                    type: 'warning',
                    title: 'La compra debe contar por lo menos con un detalle',
                    showConfirmButton: false,
                    timer: 1500
                    });
            return false;
        }

    });

    $("#btn-guardar-venta").on("click", function(){
        cantidadproductos = Number($("#tbventas tbody tr").length);
        if (cantidadproductos == 0) {
            swal({
                    position: 'center',
                    type: 'warning',
                    title: 'La venta debe contar por lo menos con un detalle',
                    showConfirmButton: false,
                    timer: 1500
                    });
            return false;
        }

    });


    $("#comprobanteVenta").on("change", function(){
        optionSelected = $(this).val();
        infoOptionSelected = optionSelected.split("*");
        if (optionSelected == '') {
            $("#comprobante_id").val(null);
            $("#iva").val(0);
        }else{
            $("#comprobante_id").val(infoOptionSelected[0]);
            $("#iva").val(infoOptionSelected[2]);
        }
        sumarVenta();
    });

    function sumarVenta(){
        subtotal = 0;
        $("#tbventas tbody tr").each(function(){
            subtotal = subtotal + Number($(this).children("td:eq(6)").find('input').val());
        });

        $("input[name=subtotal]").val(subtotal.toFixed(2));
        descuento = Number($("#descuento").val());
        porcentaje = Number($("#iva").val());
        iva = subtotal * (porcentaje/100);
        $("input[name=iva]").val(iva.toFixed(2));
        total = subtotal + iva - descuento;
        $("input[name=total]").val(total.toFixed(2));
    }

    $("#monto_recibido").on("keyup", function(){
        monto_recibido = Number($(this).val());
        total = Number($("input[name=total]").val());
        $("input[name=cambio]").val((monto_recibido - total).toFixed(2));
    });


    //old code
    $("#cantEliminar").on("keyup",function(){
        if ($(this).val() != "") {
            value = Number($(this).val());
            maxValue = Number($(this).attr("max"));
            if (value==0) {
                alertify.error("Valor no permitido");
                $(this).val(null);
            }

            if (value!=0 && value < 1) {
                alertify.error("Ud. no puede ingresar un numero menor a 1");
                $(this).val("1");
            }

            if (value > maxValue) {
                alertify.error("Ud. no puede ingresar un numero mayor a "+ maxValue);
                $(this).val(maxValue);
            }
        }
    });
    
       //Para Ocultar el Menu Automaticamente
    //$("#side-bar").mouseleave(function() {
      //  $("#collapse").trigger("click");
    //});

    $("#showCaracteres").on("change", function(){

        if ($(this).is(':checked')) {
            $("#clave").attr("type","text");
        }
        else{
            $("#clave").attr("type","password");
        }
        
    })
    $(document).on("click","#change-password",function(){

        $("input[name=idusuario]").val($(this).val());

    });
    $(document).on("submit","#form-change-password",function(e){
        e.preventDefault();
        info = $(this).serialize();
        newpassword = $("input[name=newpassword]").val();
        repeatpassword = $("input[name=repeatpassword]").val();
        if (newpassword != repeatpassword) {
            error = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> La contraseñas ingresadas no coindicen</div>';
            $(".error").html(error);
        }else{
            $.ajax({
                url: base_url + "administrador/usuarios/changepassword",
                type: "POST",
                data: info,
                success: function(resp){
                    window.location.href = base_url + resp;
                }
            });
        }
    })

    $(document).on("submit","#form-clave", function(e){
        e.preventDefault();
        data = $(this).serialize();
        $.ajax({
            url :  base_url + "movimientos/ordenes/checkClave",
            type:"POST",
            data : data,
            success:function(resp){
             
                if (resp=="1") {
                    location.reload();
                }else if(resp =="2"){
                    window.location.href = base_url + "movimientos/ordenes";
                }else{
                    alertify.error("La clave de permiso ingresada no es valida");
                }
            }
        });
    });

    $(document).on("click", ".btn-delete", function(e){
        e.preventDefault();
        url = $(this).attr("href");
        swal({
                title:"Esta seguro que desea eliminar este registro?",
                text: "Esta operacion es irreversible",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(isConfirm){
                if(isConfirm){
                    $.ajax({
                        url: url,
                        type: "POST",
                        success: function(resp){
                            window.location.href = base_url + resp;
                        }
                    });
                    }
                return false;
            });
        });


       


    $(document).on("click",".btn-cerrar-imp", function(){
        
        window.location.href = base_url + "movimientos/ordenes";
        
    });



    $(document).on("click",".btn-cerrar", function(){
        if ($("#estadoPedido").val() == "1") {
            window.location.href = base_url + "movimientos/ordenes";
        }else{
            location.reload();
        }
    });


    $("#categoria").on("change", function(){
        id = $(this).val(); 
        $.ajax({
            url: base_url + "movimientos/ordenes/getProductosByCategoria",
            type: "POST", 
            data:{idcategoria:id},
            dataType:"json",
            success:function(resp){
                html = "";
                $.each(resp,function(key, value){

                    if (value.condicion == "1") {
                        stock = value.stock;
                    }
                    else{
                        stock = "N/A";
                    }
                    data = value.id + "*"+ value.codigo+ "*"+ value.nombre+ "*"+ value.precio+ "*"+ stock;
                    html += "<tr>";
                    html += "<td>"+value.nombre+"</td>";
                    html += "<td><button type='button' class='btn btn-success btn-flat btn-selected' value='"+data+"'><span class='fa fa-check'></span></button></td>";
                    html += "</tr>";
                });

                $("#tbproductos tbody").html(html);
            }

        });
    });



    $("#monto_efectivo").on("keyup", function(){
        valor  = Number($(this).val());
        ventas = Number($("#monto_ventas").val());
        apertura = Number($("#monto_apertura").val());
        monto = ventas + apertura;
        if (valor == monto) {
            $("#observacion").val("Cuadre de Caja conforme");
        }else{
            $("#observacion").val("Cuadre de Caja no conforme");
        }
    });



    $("#btnActualizarApertura").on("click", function(){
        $("#panelApertura").hide();
        $("#formActualizarApertura").show();
    });

    $(".menu-notificaciones li").on("click", function(){
        return false;
    })

    $(".remove-notificacion").on("click", function(e){
        e.preventDefault();
        id = $(this).attr("href");
        $(this).parent().parent().remove();
        $.ajax({
            url: base_url + "notificaciones/delete",
            data: {id:id},
            type: "POST",
            success:function(resp){
                if (resp > 0 ) {
                    $(".notifications-menu a span").text(resp);
                    $(".notifications-menu ul li.header").text("Tienes "+resp+" notificaciones");
                }else{
                    $(".notifications-menu a span").remove();
                    $(".notifications-menu ul li.header").text("Tienes 0 notificaciones");
                    $(".notifications-menu ul li.footer").remove();
                }
            }
        });


        return false;
    });

    $("input[name=condicion]").click(function() {
        condicion = $(this).val();
        if (condicion == "0") {
            $("input[name=stock]").attr("disabled","disabled");
            $("input[name=stockminimo]").attr("disabled","disabled");
            $("input[name=stock]").val(null);
            $("input[name=stockminimo]").val(null);
        }else{
            $("input[name=stock]").removeAttr("disabled");
            $("input[name=stockminimo]").removeAttr("disabled");
        }
    });

    $("#descuento").on("keyup",function(){
        sumarVenta();
    });
    $("#form-comprobar-password").submit(function(e){
        e.preventDefault();
        montoDescuento = $("#montoDescuento").val();
        data = $(this).serialize();
        $.ajax({
            url: base_url + "movimientos/ventas/comprobarPassword",
            type:"POST",
            data: data,
            //dataType: "json",
            success:function(resp){
                if (resp == "1") {
                    $('#modal-default2').modal('hide');
                    $("#descuento").removeAttr("readonly");
                    
                    
                } else {
                    alertify.error("La contraseña no es válida");
                }      
            }
        });
    });

    $("#btn-pagar").on("click", function(){
        idventa = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/pagar",
            type:"POST",
            data: {id:idventa},
            //dataType: "json",
            success:function(resp){
                window.location.href = base_url + resp;         
            }
        });
    });
    $("#form-venta").submit(function(e){
        $('button[type=submit]').attr('disabled','disabled');
        $('button[type=submit]').text('Procesando...');
        e.preventDefault();

        cantidadProductos = $("#tbpago tbody tr").length;

        if (cantidadProductos < 1) {
            alertify.error("Agregue productos a pagar");
        }else{
            setEstado();
            data = $(this).serialize();
            ruta = $(this).attr("action");
            $.ajax({
                url: ruta,
                type:"POST",
                data: data,
                //dataType: "json",
                success:function(resp){
                    if (resp != "0") {
                        alertify.success("La informacion de la venta fue actualizada");
                        $("#modal-venta").modal({backdrop: 'static', keyboard: false});
                        $("#modal-venta .modal-body").html(resp);
                    }else{
                        alertify.error("No se pudo actualizar la informacion de la venta");
                    }            
                }
            });
        }

        
    });
    $("#form-cierre").submit(function(e){
        e.preventDefault();

        data = $(this).serialize();
        ruta = $(this).attr("action");
        if ($("#monto_apertura").val() == "") {
            alertify.error("Es necesario establece una apertura de caja.");
        }else{
            alertify.confirm("¿Estas seguro de cerrar la caja?", function(e){
                if (e) 
                {
                    $.ajax({
                        url: ruta,
                        type:"POST",
                        data: data,
                        success:function(resp){
                            
                            window.location.href = base_url + resp;
                            
                        }
                    });

                }
            });
        }
        
    });
    $("#form-cliente").submit(function(e){
        e.preventDefault();
        data = $(this).serialize();
        ruta = $(this).attr("action");
        $.ajax({
            url: ruta,
            type:"POST",
            data: data,
            dataType: "json",
            success:function(resp){
                
                alertify.success("El cliente se registro correctamente");
                $('#modal-default').modal('hide');
              
                $("#cliente").val(resp.nombres);
                $("#idcliente").val(resp.id);
                
            }
        });

    });

    var year = (new Date).getFullYear();
    datagrafico(base_url);
    datagraficoMeses(base_url,year);
    $("#year").on("change",function(){
        yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });
    $(".btn-remove").on("click", function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");
        //alert(ruta);
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                //http://localhost/ventas_ci/mantenimiento/productos
                window.location.href = base_url + resp;
            }
        });
    });

     $(".btn-view-producto").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/productos/view/" + id,
            type:"POST",
            success:function(resp){
                $(".modal-title").text("Informacion del Producto");
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
  
    $(".btn-view-cliente").on("click", function(){
        var cliente = $(this).val(); 
        //alert(cliente);
        var infocliente = cliente.split("*");
        html = "<p><strong>Nombre:</strong>"+infocliente[1]+"</p>"
        html += "<p><strong>Tipo de Contribuyente:</strong>"+infocliente[4]+"</p>"
        html += "<p><strong>Tipo de Documento:</strong>"+infocliente[5]+"</p>"
        html += "<p><strong>Numero  de Documento:</strong>"+infocliente[6]+"</p>"
        html += "<p><strong>Telefono:</strong>"+infocliente[3]+"</p>"
        html += "<p><strong>Direccion:</strong>"+infocliente[2]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
    $(".btn-view").on("click", function(){
        modulo = $("#modulo").val();
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/"+modulo+"/view/" + id,
            type:"POST",
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
    $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view",
            type:"POST",
            data:{idusuario:id},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });

    $(document).on("click", ".btn-edit-mesa", function(){
        id = $(this).val();
        numero = $(this).closest("tr").find("td:eq(0)").text();
        $("#idMesa").val(id);
        $("#numero").val(numero);
    });
    
    $('#table-with-buttons').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: $("h3").text(),
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5,6]
                },
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('#inventario').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Inventario Quicheladas",
                exportOptions: {
                    columns: [ 2, 4 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Inventario Quicheladas",
                exportOptions: {
                    columns: [2, 4]
                },
                
            },
            {
                extend: 'print',
                title: "Inventario Quicheladas",
                text: 'Imprimir',
                exportOptions: {
                    columns: [2, 4]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#inventario-productos').DataTable( {
       dom: 'Bfrtip',
         "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                'Q. '+pageTotal +' ( Q. '+ total +' total)'
            );
        },
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Inventario Productos",
                exportOptions: {
                    columns: [ 1, 4 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Inventario Productos",
                exportOptions: {
                    columns: [1, 4]
                },
                
            },
            {
                extend: 'print',
                title: "Inventario ¨Productos",
                text: 'Imprimir',
                exportOptions: {
                    columns: [1, 4]
                }
                
            }
        ],
        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
 
    $('#example1').DataTable({
        "pageLength": 25,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('.example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('.sidebar-menu').tree();


    $(document).on("click",".btn-check",function(){
        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        $("#modal-default").modal("hide");
    });
    $("#proveedor").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/compras/getProveedores",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){

            data = ui.item.id +"*"+ ui.item.nit + "*"+ ui.item.label;
            $("#idproveedor").val(ui.item.id);

            
        },
    });
    $("#searchProductoCompra").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/compras/getProductos",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            
            html = "<tr>";
            html +="<td><input type='hidden' name='idproductos[]' value='"+ui.item.id+"'>"+ui.item.codigo_barras+"</td>";
            html +="<td>"+ui.item.nombre+"</td>";
            html +="<td>"+ui.item.marca+"</td>";
            html +="<td><input type='hidden' name='precios[]' value='"+ui.item.precio_compra+"'>"+ui.item.precio_compra+"</td>";
            html +="<td><input type='text' name='cantidades[]' class='cantidadesCompra' value='1'></td>";
            html +="<td><input type='hidden' name='importes[]' value='"+ui.item.precio_compra+"'><p>"+ui.item.precio_compra+"</p></td>";
            html +="<td><button type='button' class='btn btn-danger btn-remove-producto-compra'><span class='fa fa-times'></span></button></td>";
            html +="</tr>"

            $("#tbcompras tbody").append(html);
            sumarCompra();
            this.value = "";
            return false;

        },
    });

    $("#searchProductoVenta").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getProductos",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            html = "<tr>";
            html +="<td><input type='hidden' name='idproductos[]' value='"+ui.item.id+"'>"+ui.item.codigo_barras+"</td>";
            html +="<td>"+ui.item.nombre+"</td>";
            html +="<td>"+ui.item.marca+"</td>";
            html +="<td><input type='hidden' name='precios[]' value='"+ui.item.precio_compra+"'>"+ui.item.precio_compra+"</td>";
            html +="<td>"+ui.item.stock+"</td>";
            html +="<td><input type='text' name='cantidades[]' class='cantidadesVenta' value='1' onkeypress='validate(event)'></td>";
            html +="<td><input type='hidden' name='importes[]' value='"+ui.item.precio_compra+"'><p>"+ui.item.precio_compra+"</p></td>";
            html +="<td><button type='button' class='btn btn-danger btn-remove-producto-compra'><span class='fa fa-times'></span></button></td>";
            html +="</tr>"

            $("#tbventas tbody").append(html);
            sumarVenta();
            this.value = "";
            return false;
        },
    });


    
    //autcompletador para productos asociados
    $("#productosA").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getProductos",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){

            html =  '<tr>'+
                        '<td><input type="hidden" name="idproductosA[]" value="'+ ui.item.id +'">'+ ui.item.label +'</td>'+
                        '<td><input type="number" name="cantidadA[]" class="form-control"  value="1" min="1"></td>'+
                        '<td><button type="button" class="btn btn-danger btn-quitarAsociado"><i class="fa fa-times"></i></button></td>'+
                    '</tr>';
            $("#tbAsociados tbody").append(html);
        },
    });

    $(document).on("click", ".btn-quitarprod", function(){
        data = $(this).val();
        info = data.split("*");
        $("#idOrden").val(info[0]);
        $("#idProducto").val(info[1]);
        $("#cantEliminar").val(info[2]);
        $("#cantEliminar").attr('max',info[2]);
        $("#idPedidoProd").val(info[3]);


    })

    $(document).on("click",".btn-quitarAsociado", function(){
        $(this).closest("tr").remove();
    });
    
    $(document).on("click",".btn-delprod", function(){
        $(this).closest("tr").remove();
    });

    $("#btn-agregar").on("click",function(){
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
            html += "<td>"+infoproducto[4]+"</td>";
            html += "<td><input type='number' min='0' name='cantidades[]' value='1' class='cantidades'></td>";
            html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
            html += "</tr>";
            $("#tbventas tbody").append(html);
            sumar();
            $("#btn-agregar").val(null);
            $("#producto").val(null);

        }else{
            alertify.error("Seleccione un producto...");
        }
    });

    $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumar();
    });
    $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumar();
    });
    $(document).on("keyup mouseup","#tbventas input.cantidades", function(){
        cantidad = Number($(this).val());
        precio = Number($(this).closest("tr").find("td:eq(2)").text());
        stock = Number($(this).closest("tr").find("td:eq(3)").text());

        if (cantidad > stock) {
            $(this).val(stock);
            alertify.error("La cantidad ingresada no debe sobrepasar el stock del producto");
            importe = stock * precio;
            $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
            sumar();
        }
        else{
           
            importe = cantidad * precio;
            $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
            sumar();
        }
    });
    $(document).on("click",".btn-view-venta",function(){
        valor_id = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-venta .modal-body").html(data);
            }
        });
    });
    $(document).on("click",".btn-print-pedido",function(){
        $(".contenido-pedido").addClass("impresion");
        $(".contenido-pedido").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });

    $(document).on("click",".btn-print",function(){
        
        $(".modal-body").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });
    $(document).on("click",".btn-print-cierre",function(){
        $(".contenido-cierre").addClass("impresion");
        $(".contenido-cierre").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });

    $(document).on("click",".btn-print-barcode",function(){
        
        $("#modal-barcode .modal-body").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });
})

function generarnumero(numero){
    if (numero>= 99999 && numero< 999999) {
        return Number(numero)+1;
    }
    if (numero>= 9999 && numero< 99999) {
        return "0" + (Number(numero)+1);
    }
    if (numero>= 999 && numero< 9999) {
        return "00" + (Number(numero)+1);
    }
    if (numero>= 99 && numero< 999) {
        return "000" + (Number(numero)+1);
    }
    if (numero>= 9 && numero< 99) {
        return "0000" + (Number(numero)+1);
    }
    if (numero < 9 ){
        return "00000" + (Number(numero)+1);
    }
}



function sumar(){
    subtotal = 0;
    $("#tbpago tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(3)").text());
    });

    $("input[name=subtotal]").val(subtotal.toFixed(2));
    porcentaje = Number($("#igv").val());
    igv = subtotal * (porcentaje/100);
    $("input[name=iva]").val(igv.toFixed(2));
    descuento = Number($("input[name=descuento]").val());
    total = subtotal + igv - descuento;
    $("input[name=total]").val(total.toFixed(2));

    $(".subtotal").text(subtotal.toFixed(2));
    $(".iva").text(igv.toFixed(2));
    $(".descuento").text(descuento.toFixed(2));
    $(".total").text(total.toFixed(2));

}
function datagrafico(base_url){
    /*namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];*/
    $.ajax({
        url: base_url + "Grafico/getData",
        type:"POST",
        dataType:"json",
        success:function(data){
            var dias = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                dias.push(value.fecha);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficar(dias,montos);
        }
    });
}
function datagraficoMeses(base_url,year){
    namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];
    $.ajax({
        url: base_url + "dashboard/getData",
        type:"POST",
        data:{year: year},
        dataType:"json",
        success:function(data){
            var meses = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficarMeses(meses,montos,year);
        }
    });
}

function graficar(dias,montos){
    Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monto acumulado por ventas diarias'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: dias,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (Quetzales)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} Quetzales</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }

            }
        }
    },
    series: [{
        name: 'Dias',
        data: montos

    }]
});
}
function graficarMeses(meses,montos,year){
    Highcharts.chart('graficoMeses', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monto acumulado por las ventas de los meses'
    },
    subtitle: {
        text: 'Año:' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (soles)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} soles</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }

            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos

    }]
});
}

function descontarStock(id,stock,asociado){
    alert(id + " " +stock + " "+asociado);

    $.ajax({
        url : base_url + "movimientos/ventas/descontarStock",
        type: "POST",
        data: {idproducto:id,stock:stock,asociado:asociado},
        success: function(resp){
            alert(resp);
        }

    });
}

function comprobar(){
    var contador=0;
 
    // Recorremos todos los checkbox para contar los que estan seleccionados
    $("#tborden input[type=checkbox]").each(function(){
        if($(this).is(":checked"))
            contador++;
    });
    totalfilas = $("#tborden tbody tr").length;

    if (totalfilas == contador) {
        $("#estadoPedido").val("1");
    }else{
        $("#estadoPedido").val("0");
    }

} 

function setEstado(){

    sumaValor = 0;
    $(".cantidades").each(function(){
        
        valor = Number($(this).val());
        
        sumaValor = sumaValor + valor;
    });

    sumaPag = Number($("#sumaPag").val());
    sumaCant = Number($("#sumaCant").val());
    totalPag = sumaValor + sumaPag;

    if (sumaCant != totalPag) {
        $("#estadoPedido").val("0");
    }else{
        $("#estadoPedido").val("1");
    }
}


function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function validate(e) {
  var ev = e || window.event;
  var key = ev.keyCode || ev.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]/;
  if( !regex.test(key) ) {
    ev.returnValue = false;
    if(ev.preventDefault) ev.preventDefault();
  }
}