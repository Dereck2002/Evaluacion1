<?php
require_once('../Models/cls_productos.model.php');
$productos = new Clase_Productos;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array(); 
        $datos = $productos->todos();
        while ($fila = mysqli_fetch_assoc($datos)) { 
            $todos[] = $fila;
        }
        echo json_encode($todos); 
        break;
    case "uno":
        $ID_producto = $_POST["ID_producto"]; 
        $datos = array(); 
        $datos = $productos->uno($ID_producto); 
        $uno = mysqli_fetch_assoc($datos); 
        echo json_encode($uno); 
        break;
    case 'insertar':
        $ID_categoria = $_POST["ID_categoria"];
        $Nombre = $_POST["Nombre"];
        $Precio = $_POST["Precio"];
        $Stock = $_POST["Stock"];
        $datos = array(); 
        $datos = $productos->insertar($Nombre,$Precio, $ID_categoria, $Stock);
        echo json_encode($datos); 
        break;
    case 'actualizar':
        $ID_producto = $_POST["ID_producto"];
        $ID_categoria = $_POST["ID_categoria"];
        $Nombre = $_POST["Nombre"];
        $Precio = $_POST["Precio"];
        $Stock = $_POST["Stock"];
        $datos = array(); 
        $datos = $productos->actualizar($ID_producto, $Nombre, $Precio, $ID_categoria, $Stock); 
        echo json_encode($datos); 
        break;

    case 'eliminar':
        $ID_producto = $_POST["ID_producto"]; 
        $datos = array(); 
        $datos = $productos->eliminar($ID_producto); 
        echo json_encode($datos); 
        break;
}
