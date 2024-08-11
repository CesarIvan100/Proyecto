<?php
include_once '../models/Producto.php';

class ProductoController {
    
    public function index() {
        $productos = Producto::getAll();
        include '../views/producto/index.php';
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto();
            $producto->nombre = $_POST['nombre'];
            $producto->precio = $_POST['precio'];
            $producto->stock = $_POST['stock'];
            $producto->save();
            header('Location: ../views/producto/index.php');
            exit();
        } else {
            include '../views/producto/create.php';
        }
    }
    
    public function update($id) {
        $producto = Producto::find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto->nombre = $_POST['nombre'];
            $producto->precio = $_POST['precio'];
            $producto->stock = $_POST['stock'];
            $producto->update();
            header('Location: ../views/producto/index.php');
            exit();
        } else {
            include '../views/producto/update.php';
        }
    }
    
    public function delete($id) {
        $producto = Producto::find($id);
        $producto->delete();
        header('Location: ../views/producto/index.php');
        exit();
    }
}
?>
