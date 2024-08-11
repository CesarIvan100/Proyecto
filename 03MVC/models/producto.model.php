<?php
include_once '../db_connection.php';

class Producto {
    
    public $id;
    public $nombre;
    public $precio;
    public $stock;
    
    // Obtener todos los productos
    public static function getAll() {
        global $conn; 
        $sql = "SELECT * FROM Productos";
        $result = $conn->query($sql);
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto();
            $producto->id = $row['idProductos'];
            $producto->nombre = $row['Nombre_Producto'];
            $producto->precio = $row['Precio'];
            $producto->stock = $row['Stock'];
            $productos[] = $producto;
        }
        return $productos;
    }
    
    // Encontrar un producto por ID
    public static function find($id) {
        global $conn; 
        $sql = "SELECT * FROM Productos WHERE idProductos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $producto = new Producto();
        $producto->id = $row['idProductos'];
        $producto->nombre = $row['Nombre_Producto'];
        $producto->precio = $row['Precio'];
        $producto->stock = $row['Stock'];
        return $producto;
    }
    
    // Guardar un nuevo producto
    public function save() {
        global $conn; 
        $sql = "INSERT INTO Productos (Nombre_Producto, Precio, Stock) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $this->nombre, $this->precio, $this->stock);
        $stmt->execute();
    }
    
    // Actualizar un producto existente
    public function update() {
        global $conn; 
        $sql = "UPDATE Productos SET Nombre_Producto = ?, Precio = ?, Stock = ? WHERE idProductos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdii", $this->nombre, $this->precio, $this->stock, $this->id);
        $stmt->execute();
    }
    
    // Eliminar un producto
    public function delete() {
        global $conn; 
        $sql = "DELETE FROM Productos WHERE idProductos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
    }
}
?>
