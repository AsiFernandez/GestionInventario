<?php
session_start();
if (isset($_SESSION['inventario'])) {
  $inventario = $_SESSION['inventario'];
} else {
  $inventario = array();
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Gestor de Inventario</title>
</head>
<body>
<h1> Gestion de Inventario </h1>
<!-- estructura del formulario -->
  <form method="post" action="#">
    Codigo: <input type="text" name="codigo"  value="<?php $_POST['codigo'] ?> " required>
    <br><br>
    Descripcion: <input type="text" name="descripcion" value="<?php $_POST['codigo'] ?> ">
    <br><br>
    Stock: <input type="text" name="stock" value="<?php $_POST['codigo'] ?> ">
    <br><br>
    <input type="submit" value="Añadir producto al inventario" name="enviar">
  </form>
  <hr>

  <?php 
        //cuando se pulse en boton de enviar comprueba que los datos del formulario estan rellenos  
        if ($_POST["enviar"]) {
            

            //cuando se pulse en boton de enviar comprueba que los datos del formulario estan rellenos  
        if (preg_match("/^[a-zA-Z0-9]*$/", $_GET['codigo']) and preg_match("/^[a-zA-Z0-9]*$/", $_GET['descripcion'])) {
            //crea un nuevo array asociativo con los valores de los campos
            $producto_nuevo = [
            "codigo" => $_POST["codigo"],
            "descripcion" => $_POST["descripcion"],
            "stock" => $_POST["stock"]
            ];
        
            $existe = false;
            for ($i=0; $i < count($inventario) ; $i++) {
            if ($inventario[$i]["codigo"] == $producto_nuevo["codigo"]) {
                $existe = true;
                $inventario[$i]["descripcion"] = $producto_nuevo["descripcion"];
                $inventario[$i]["stock"] = $producto_nuevo["stock"];
            }
            }
            if (!$existe) {
            array_push($inventario, $producto_nuevo);
            }

        } else if (trim($_POST["codigo"]) != "") {
            for ($i=0; $i < count($inventario) ; $i++) {
            if ($inventario[$i]["codigo"] == $_POST["codigo"]) {
                unset($inventario[$i]);
            }
            }
        } else {
            echo "El nombre Y la descripcion son obligatorios. El stock debe de ser un numero mayor que 0 <br><br>";
        }
        }

        //Recorremos el aray de productos con un foreach, y mostramos os datos con un echo
            foreach ($inventario as $producto) {
                
                echo "codigo: " . $producto["codigo"] . "<br>descripcion: " . $producto["descripcion"] ."<br>Stock: " . $producto["stock"] . "<hr>";
            }


        $_SESSION["inventario"] = $inventario;
        //bloque de accion
        ?>
</body>
</html>

        