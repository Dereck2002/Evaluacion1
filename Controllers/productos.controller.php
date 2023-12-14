<?php
require_once('../Models/cls_productos.model.php');
$productos = new Clase_Productos;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array(); //defino un arreglo
        $datos = $productos->todos(); //llamo al modelo de usuarios e invoco al procedimiento todos y almaceno en una variable
        while ($fila = mysqli_fetch_assoc($datos)) { //recorro el arreglo de datos
            $todos[] = $fila;
        }
        echo json_encode($todos); //devuelvo el arreglo en formato json
        break;
    case "uno":
        $ID_producto = $_POST["ID_producto"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $productos->uno($ID_producto); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
    case 'insertar':
        $ID_categoria = $_POST["ID_categoria"];
        $Nombre = $_POST["Nombre"];
        $Precio = $_POST["Precio"];
        $Stock = $_POST["Stock"];
        $datos = array(); //defino un arreglo
        $datos = $productos->insertar($Nombre,$Precio, $ID_categoria, $Stock); //llamo al modelo de usuarios e invoco al procedimiento insertar
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'actualizar':
        $ID_producto = $_POST["ID_producto"];
        $ID_categoria = $_POST["ID_categoria"];
        $Nombre = $_POST["Nombre"];
        $Precio = $_POST["Precio"];
        $Stock = $_POST["Stock"];
        $datos = array(); //defino un arreglo
        $datos = $productos->actualizar($ID_producto, $Nombre, $Precio, $ID_categoria, $Stock); //llamo al modelo de usuarios e invoco al procedimiento actual
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'eliminar':
        $ID_producto = $_POST["ID_producto"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $productos->eliminar($ID_producto); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
}
