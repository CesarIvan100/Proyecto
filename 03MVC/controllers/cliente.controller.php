<?php
include_once '../models/Cliente.php';

class ClienteController {
    
    public function index() {
        $clientes = Cliente::getAll();
        include '../views/cliente/index.php';
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente = new Cliente();
            $cliente->nombres = $_POST['nombres'];
            $cliente->direccion = $_POST['direccion'];
            $cliente->telefono = $_POST['telefono'];
            $cliente->cedula = $_POST['cedula'];
            $cliente->correo = $_POST['correo'];
            $cliente->save();
            header('Location: ../views/cliente/index.php');
            exit();
        } else {
            include '../views/cliente/create.php';
        }
    }
    
    public function update($id) {
        $cliente = Cliente::find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente->nombres = $_POST['nombres'];
            $cliente->direccion = $_POST['direccion'];
            $cliente->telefono = $_POST['telefono'];
            $cliente->cedula = $_POST['cedula'];
            $cliente->correo = $_POST['correo'];
            $cliente->update();
            header('Location: ../views/cliente/index.php');
            exit();
        } else {
            include '../views/cliente/update.php';
        }
    }
    
    public function delete($id) {
        $cliente = Cliente::find($id);
        $cliente->delete();
        header('Location: ../views/cliente/index.php');
        exit();
    }
}
?>