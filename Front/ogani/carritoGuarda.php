<?php
include("../../BD/conexion.php");

$clClave= $_GET["cliente"];
$totSolicitado = $_GET["cant"];
$inClave = $_GET["inventa"];
$miAccion = "insCarrito";
$iva = 0.16;





echo "<br>c.cliente ".$clClave;
echo "<br> cantidad  ".$totSolicitado;
echo "<br> c.inventario ".$inClave;
echo "<br> accion ".$miAccion;
echo "<br> ";


if ($miAccion == "insCarrito"){
  
    //busca la cantidad maximo productos disponible
    $sqlexisten = "select inventario.*, pro_precio,pro_precioIVA from inventario, productos where inventario.inv_id = $inClave and inventario.pro_id = productos.pro_id";
                  //echo "<br>".$sqlexisten;
    $resexisten = mysqli_query($conn,$sqlexisten);
    $maxExisten = mysqli_fetch_assoc($resexisten);
    $maxDisponible  =  $maxExisten["inv_existencia"]; //cantidad disponible en tabla inventarios
    $prCostoIVA =  $maxExisten["pro_precioIVA"]; // costo del productos
    $prPrecio = $maxExisten["pro_precio"];
    echo "<br> cantidad maxima $maxDisponible";
    echo "<br> Costo del producto con iva $prCostoIVA";
    echo "<br> Costo del producto sin iva $prPrecio";

    //Consulta si el producto existe en el detalle de carrito del cliente 
    $sqlprodExis = "
    select * from carrito, carr_inv where carrito.car_id = carr_inv.car_id and usu_id = $clClave and inv_id = $inClave";
    $resprodExis = mysqli_query($conn,$sqlprodExis);
    $regs = mysqli_num_rows($resprodExis);
    echo "<br> Resultado si existe detalle carrito $regs";
    
    if ( $regs == 1 ) { 
      //si el producto ya existe car_inv del cliente, suma los productos
      $filaprodExis= mysqli_fetch_assoc($resprodExis);
      $totSolicitado = $filaprodExis["carinv_cantidad"] + $totSolicitado; //suma la cantidad pedida + la que ya existe 
      $carrClave = $filaprodExis["car_id"];
      echo "<br> total de producto a calcular $totSolicitado";
    }else{
      //sino hay detalle de productos, revisa que existe el carrito
      $sqlprodExis = "select * from carrito where usu_id = $clClave ";
      $resprodExis = mysqli_query($conn,$sqlprodExis);
      $resultadot = mysqli_num_rows($resprodExis);
      echo "<br> este es el resultado para ver si exite el carrito $resultadot";
  
      if ($abc = mysqli_num_rows($resprodExis) == 0 ){
         $sqlcreaCarr = "insert into carrito (usu_id, car_fechaC) values ($clClave,now() )";
         $rescreaCarr = mysqli_query($conn,$sqlcreaCarr);
         echo "<br> $sqlcreaCarr";
         //$rescreaCarr = mysqli_query($conn,$sqlcreaCarr);
         $carrClave = mysqli_insert_id($conn);
      }else{
      $filaprodExis= mysqli_fetch_assoc($resprodExis);
      $carrClave = $filaprodExis["car_id"];
      $totSolicitado =  $totSolicitado; //revisar cuando no hay otro producto
      }
  
    }
    echo "<br> Id del carrito del cliente actual $carrClave";
   
     if ($totSolicitado > $maxDisponible) {
      echo "<br> Error. La cantidad debe ser menor o igual a la existencia.";
      //
    } elseif ($totSolicitado > $maxDisponible) {
      echo "<br> Esta solicitando ".$totSolicitado." productos. En su carrito ya existe ".$filaprodExis["carinv_cantidad"]." producto de la misma sucuarsal. La cantidad total sobrepasa la existencia de la sucursal .".$totSolicitado;
    }else{
      echo "<br> Alta de carrito <br>";
       //el carrito ya existe en t.carrito
      //revisa si el producto ya está en el carrito   
      if ($regs==1) { //si ya está el producto en el detalle del carrito (car_inv)
        $sqlinsProd = "update carr_inv set carinv_cantidad =$totSolicitado, carinv_subtotal =  $totSolicitado*$prCostoIVA
                       where car_id = $carrClave ";
        $resactualizaCarrito = mysqli_query($conn,$sqlinsProd);

                      
      }else{ //si el producto no está en car_inv y se agrega
        $sqlinsProd = "insert into carr_inv (car_id, inv_id, carinv_cantidad, carinv_subtotal) values 
                      ($carrClave, $inClave, $totSolicitado, $totSolicitado*$prCostoIVA ) ";
        $rescreaCarrInv = mysqli_query($conn,$sqlinsProd);
        echo "<br> $sqlinsProd"; 
      } // if ($rescarrExis) {s
      
      //Actualiza t. Carrito

      $sqlsubcar = "select * from carrito";
      $ressubca = mysqli_query($conn, $sqlsubcar); 
      $filasuca = mysqli_fetch_assoc($ressubca);
      $subtotalcarrito=$filasuca['car_subtotal'];
      $sqlsubt = "select sum(carinv_subtotal) as totart from carr_inv where car_id = $carrClave ";
      $ressubt = mysqli_query($conn, $sqlsubt); 
      $filasubt = mysqli_fetch_assoc($ressubt);
      $totcarr = $filasubt['totart'];
      $subtotalcarr =  $prPrecio*$totSolicitado;
      $IVAPRODUCTO = ($prPrecio * $iva)*$totSolicitado;



      echo "<br> Este es el IVA DEL PRODUCTO $IVAPRODUCTO";
      echo "<br> Este es el total nuevo $totcarr";
      echo "<br> Este es el subtotal nuevo $subtotalcarr";

  
      $sqlactualizaCarr = "update carrito set car_total = $totcarr, car_subtotal = $subtotalcarrito + $subtotalcarr, car_iva=$IVAPRODUCTO
      where car_id = $carrClave ";
      $resactualizaCarr = mysqli_query($conn, $sqlactualizaCarr);
      echo "<br> $sqlactualizaCarr";
  
    }// if ($prCant > $maxDisponible) 
  };  //$miAccion //($prCant > $maxDisponible)
  header("Location: shoping-cart.php");
    mysqli_close($conn); 
  
  