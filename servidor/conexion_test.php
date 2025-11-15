<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'TareasDB.php';

try {
    // Creamos la instancia
    $db = new TareasDB();

    // Probamos ejecutar una consulta simple
    $resultado = $db->dameLista();

    echo json_encode([
        "ok" => true,
        "mensaje" => "Conexión exitosa a la base de datos",
        "total_tareas" => count($resultado)
    ], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        "ok" => false,
        "error" => $e->getMessage()
    ]);
}
?>
