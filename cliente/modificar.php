<?php
require_once "Rutas.php";
$rutas = new Rutas();
$id = $_GET['id'];

// Obtener el registro actual
$url = $rutas->dameUrlBase().'/servidor/index.php?action=tareas&id='.$id;
$json = file_get_contents($url);
$registro = json_decode($json, true);

// Validar que se obtuvo el registro
if (!is_array($registro) || count($registro) === 0) {
    echo "<p>Error: No se pudo obtener el registro con ID $id.</p>";
    $registro = [[]]; // Para evitar errores en el formulario
}

// Si se envió el formulario, actualizar el registro
if (isset($_POST['titulo'])) {
    $url = $rutas->dameUrlBase().'/servidor/index.php?action=tareas&id='.$id;
    $data = array(
        'titulo' => $_POST['titulo'],
        'descripcion' => $_POST['descripcion'],
        'prioridad' => $_POST['prioridad']
    );
    $postdata = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);

    echo "<p>Registro modificado correctamente.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar tarea</title>
</head>
<body>
    <?php echo $rutas->dameMenuInicio()."&nbsp;&nbsp;&nbsp;&nbsp;".$rutas->dameMenuNuevo(); ?>
    <br>

    <?php if (!isset($_POST['titulo'])): ?>
        <form method="post" id="form1">
            <label for="titulo">Título:</label><br>
            <input type="text" id="titulo" name="titulo" value="<?php echo $registro[0]['titulo']; ?>"><br>

            <label for="descripcion">Descripción:</label><br>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $registro[0]['descripcion']; ?>"><br>

            <label for="prioridad">Prioridad:</label><br>
            <select name="prioridad" id="prioridad">
                <option value="1" <?php if ($registro[0]['prioridad'] == 1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if ($registro[0]['prioridad'] == 2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if ($registro[0]['prioridad'] == 3) echo 'selected'; ?>>3</option>
                <option value="4" <?php if ($registro[0]['prioridad'] == 4) echo 'selected'; ?>>4</option>
                <option value="5" <?php if ($registro[0]['prioridad'] == 5) echo 'selected'; ?>>5</option>
            </select><br><br>

            <button type="submit" form="form1">Guardar</button>
        </form>
    <?php endif; ?>
</body>
</html>