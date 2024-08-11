<?php
include_once '../db_connection.php';

class Cliente {
    
    public $id;
    public $nombres;
    public $direccion;
    public $telefono;
    public $cedula;
    public $correo;
    
    public static function getAll() {
        global $conn;
        $sql = "SELECT * FROM Clientes";
        $result = $conn->query($sql);
        $clientes = [];
        while($row = $result->fetch_assoc()) {
            $cliente = new Cliente();
            $cliente->id = $row['idClientes'];
            $cliente->nombres = $row['Nombres'];
            $cliente->direccion = $row['Direccion'];
            $cliente->telefono = $row['Telefono'];
            $cliente->cedula = $row['Cedula'];
            $cliente->correo = $row['Correo'];
            $clientes[] = $cliente;
        }
        return $clientes;
    }
    
    public static function find($id) {
        global $conn;
        $sql = "SELECT * FROM Clientes WHERE idClientes = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $cliente = new Cliente();
        $cliente->id = $row['idClientes'];
        $cliente->nombres = $row['Nombres'];
        $cliente->direccion = $row['Direccion'];
        $cliente->telefono = $row['Telefono'];
        $cliente->cedula = $row['Cedula'];
        $cliente->correo = $row['Correo'];
        return $cliente;
    }
    
    public function save() {
        global $conn;
        $sql = "INSERT INTO Clientes (Nombres, Direccion, Telefono, Cedula, Correo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $this->nombres, $this->direccion, $this->telefono, $this->cedula, $this->correo);
        $stmt->execute();
    }
    
    public function update() {
        global $conn;
        $sql = "UPDATE Clientes SET Nombres = ?, Direccion = ?, Telefono = ?, Cedula = ?, Correo = ? WHERE idClientes = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $this->nombres, $this->direccion, $this->telefono, $this->cedula, $this->correo, $this->id);
        $stmt->execute();
    }
    
    public function delete() {
        global $conn;
        $sql = "DELETE FROM Clientes WHERE idClientes = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
    }
}
?>