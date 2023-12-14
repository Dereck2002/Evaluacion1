<?php
require_once('../Models/cls_categorias.models.php');
$categorias = new Clase_Categorias;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array(); //defino un arreglo
        $datos = $categorias->todos(); //llamo al modelo de usuarios e invoco al procedimiento todos y almaceno en una variable
        while ($fila = mysqli_fetch_assoc($datos)) { //recorro el arreglo de datos
            $todos[] = $fila;
        }
        echo json_encode($todos); //devuelvo el arreglo en formato json
        break;
    case "uno":
        $ID_categoria = $_POST["ID_categoria"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $categorias->uno($ID_categoria); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
    case 'insertar':
        $Nombre = $_POST["Nombre"];
        $Descripcion = $_POST["Descripcion"];
        $datos = array(); //defino un arreglo
        $datos = $categorias->insertar($Nombre, $Descripcion); //llamo al modelo de usuarios e invoco al procedimiento insertar
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'actualizar':
        $ID_categoria = $_POST["ID_categoria"];
        $Nombre = $_POST["Nombre"];
        $Descripcion = $_POST["Descripcion"];
        $datos = array(); //defino un arreglo
        $datos = $categorias->actualizar($ID_categoria, $Nombre, $Descripcion); //llamo al modelo de usuarios e invoco al procedimiento actual
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'eliminar':
        $ID_categoria = $_POST["ID_categoria"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $categorias->eliminar($ID_categoria); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
}
