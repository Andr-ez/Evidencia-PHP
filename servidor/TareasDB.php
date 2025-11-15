<?php

class TareasDB {
protected $mysqli;
const LOCALHOST = 'localhost'; // 127.0.0.1
const USER = 'root';
const PASSWORD = '';
const DATABASE = 'agenda';

/**
* Constructor de clase Inicializa la variable mysqli
*/
public function __construct() {
    // Activar excepciones en mysqli para obtener errores detallados
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Intentar conectar (sin especificar puerto explícito)
        $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        // Verificar explícitamente
        if ($this->mysqli->connect_errno) {
            throw new Exception($this->mysqli->connect_error, $this->mysqli->connect_errno);
        }
    } catch (Throwable $e) {
        // Devolver error detallado en JSON (temporal, para debug)
        http_response_code(500);
        echo json_encode([
            "error" => "Error de conexión a la base de datos",
            "detalle" => $e->getMessage(),
            "codigo" => $e->getCode()
        ]);
        exit;
    }
}

public function dameUnoPorId($id=0){ //función que retorna un registro por medio de una id
    $stmt = $this->mysqli->prepare("SELECT * FROM tareas
    WHERE id=? ; "); // se prepara la consulta con prepare por medio de la conexión que tenemos
    $stmt->bind_param('i', $id); // en lugar de la interrogación, coloque el valor de la variable id
    $stmt->execute();
    $result = $stmt->get_result();
    $tarea = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $tarea;
}
public function dameLista() {
    // Ejecuta la consulta SQL para obtener todos los registros
    $result = $this->mysqli->query('SELECT * FROM tareas');

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Convierte el resultado en un array asociativo
        $tareas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $tareas;
    } else {
        // Si hay error, devuelve un array vacío
        return [];
    }
}

public function guarda($titulo, $descripcion, $prioridad){
    $stmt = $this->mysqli->prepare("INSERT INTO tareas(titulo, descripcion, prioridad) VALUES(?, ?, ?)");
    $stmt->bind_param('ssi', $titulo, $descripcion, $prioridad);
    $r = $stmt->execute();
    $stmt->close();
    return $r;
}
public function elimina($id=0) { //esta función elimina un registro
    $stmt = $this->mysqli->prepare("DELETE FROM tareas
    WHERE id = ?");
    $stmt->bind_param('i', $id);
    $r = $stmt->execute();
    $stmt->close();
    return $r;
}

public function actualiza($id, $titulo, $descripcion, $prioridad){
//esta función actualiza un registro
    if($this->verificaExistenciaPorId($id)){
    $stmt = $this->mysqli->prepare("UPDATE tareas SET
    titulo=?, descripcion=?, prioridad=? WHERE id = ?");
    $stmt->bind_param('ssii', $titulo, $descripcion,
    $prioridad, $id);
    $r = $stmt->execute();
    $stmt->close();
    return $r;
    }
return false;
}
public function verificaExistenciaPorId($id){//esta función verifica que exista un registro por id
    $stmt = $this->mysqli->prepare("SELECT * FROM tareas
    WHERE ID=?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        $stmt->store_result();
            if ($stmt->num_rows == 1){
            return true;
            }
        }
        return false;
    }
}