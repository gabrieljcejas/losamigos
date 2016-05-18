function borrarfila(i){    
    
    $("#del-"+i).remove();    

    calculartotal();

    var nro_fila = $('#tabla_ventas >tbody >tr').length;                   

    if (nro_fila==0){
        $( "#ventas-total" ).val("0");
    }
}

function calculartotal(){
    
    var suma = 0;  
    
    $( "input[name='total[]']" ).each(function() {        
        suma = parseFloat($(this).val()) + suma;               
        $( "#ventas-total" ).val(suma);
    });  
}


// cuando cambia la cantidad cambia el precio total y suma el precio total de la venta
function myFunction(nrofila){    
   
    var nro_fila =  nrofila;           
    var total=0;
    var cantidad=0;
    var precio_venta=0;

    $("input[name='cantidad[]']").each(function(){      

        cantidad = parseFloat($("#cantidad"+nro_fila).val());                          
        precio_venta = parseFloat($("#precio_venta"+nro_fila).val());           
        //alert("cantidad "+ cantidad + " precio_venta "+precio_venta);
        if (cantidad!="" && cantidad>=0){
            $("#total"+nro_fila).val(precio_venta*cantidad);     
        }
        else{            
            $("#total"+nro_fila).val("0.00");   
        }
        return false;            
    }); 
    
    calculartotal();
            
}

$(function () {   

    //Modal Button Agregar Cliente
     $("#agregarcliente").on( "click", function() {
       $( "#modal").modal('show').find('#modalContent').load($(this).attr('value'));
        
    }); 
    
    // coloco el valor del radio en el input forma de pago
    $( "input[type=radio]" ).on( "click", function() {
        var valor = $(this).data("id");                       
        $("#ventas-forma_pago").val(valor);
    }); 

    $("input[name='envio']").on( "click", function() {
      
      // si elige envio (el otro tiene el label "retira" pero tiene el mismo nombre envio)
      if ($(this).val() == 1 ){
        
        var html='';                        
        var nro_fila = $('#tabla_ventas >tbody >tr').length + 1;  

        html+="<tr id='del-" + nro_fila + "'>";
        html+="<td><input type='text' id='cantidad"+ nro_fila +"' name='cantidad[]' value='1' class='form-control' style='width: 50px;' onkeyup='myFunction("+nro_fila+")'></td>";                
        html+="<td><input type='text' readOnly='readOnly' style='width: 200px;' name='producto[]' value='Envio' class='form-control'><input type='hidden' name='producto_id[]' value='-1' class='form-control' data-fila='"+nro_fila+"'></td>";
        html+="<td><input type='text' readOnly='readOnly'  id='precio_venta" + nro_fila + "' name='precio_venta[]' value='10' class='form-control'></td>";
        html+="<td><input type='text'  id='total" + nro_fila + "' name='total[]' value='10' class='form-control'  readOnly='readOnly'></td>";
        html+="<td><a id='btn_borrar_cuenta' onClick='borrarfila(" + nro_fila + ");' class='btn btn-default glyphicon glyphicon-trash'></a></td>";
        html+="</tr>";

        $("#tabla_ventas").append(html);               

        //agrego la suma de la columna precio total al input total
        calculartotal();
      }
        
    }); 


    $(".btn_producto").click(function(){                      
      

        var html='';                        
        var nro_fila = $('#tabla_ventas >tbody >tr').length + 1;            
        var boton_prodid = $(this).data("ide");            
        var flag = false;
        var prod_id = 0;
        var precio_venta = 0;
        var cantidad = 0;

        
        $("input[name='producto_id[]']").each( function() {
            
            var fila = $(this).data("fila"); 
            var cantidad = parseFloat($("#cantidad"+fila).val());
            var precioventa = parseFloat($("#precio_venta"+fila).val());
            var suma = 0;
            
            if (boton_prodid == $(this).val()){                    
                flag = true;
                suma = cantidad + 1;
                $("#cantidad"+fila).val(suma);                    
                $("#total"+fila).val(suma*precioventa);
            }
        });

        if (flag == false){
            html+="<tr id='del-" + nro_fila + "'>";
                html+="<td><input type='text' id='cantidad"+ nro_fila +"' name='cantidad[]' value='1' class='form-control' style='width: 50px;' onkeyup='myFunction("+nro_fila+")'></td>";                
                html+="<td><input type='text' readOnly='readOnly' style='width: 200px;' name='producto[]' value='" + $(this).data("nombre") + "' class='form-control'><input type='hidden' name='producto_id[]' value='" + $(this).data("ide") + "' class='form-control' data-fila='"+nro_fila+"'></td>";
                html+="<td><input type='text' readOnly='readOnly'  id='precio_venta" + nro_fila + "' name='precio_venta[]' value='" + $(this).data("precio_venta") + "' class='form-control'></td>";
                html+="<td><input type='text'  id='total" + nro_fila + "' name='total[]' value='" + $(this).data("precio_venta") + "' class='form-control'  readOnly='readOnly'></td>";
                html+="<td><a id='btn_borrar_cuenta' onClick='borrarfila(" + nro_fila + ");' class='btn btn-default glyphicon glyphicon-trash'></a></td>";
            html+="</tr>";

            $("#tabla_ventas").append(html);               
        }

        //agrego la suma de la columna precio total al input total
        calculartotal();
                     
    });

    $("#ventas-paga").on("keyup", function() {

        var total = parseFloat($("#ventas-total").val());
        var paga = parseFloat($("#ventas-paga").val());
        var vuelto =  paga - total;
        //alert(vuelto);
        
        $("#ventas-vuelto").val(vuelto);    
    });

     $('#ventas-cliente_id').change(function () {
        
        $.ajax({
            type: "POST",
            url: "../web/index.php?r=ventas/get-info-cliente",
            data: {id: $(this).val()},
            dataType: "json",
            success: function (data) {
                 $.each(data, function(i, clientes) {
                    //alert(clientes.domicilio);
                    $("#cliente_domicilio").text("DOMICILIO: "+clientes.domicilio);
                    $("#cliente_telefono").text("TEL: "+ clientes.telefono);
                });
           }

        });
    });
    
});




