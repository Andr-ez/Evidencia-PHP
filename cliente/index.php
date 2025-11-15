<?php
require_once "Rutas.php";
$rutas = new Rutas();

// Aquí define la URL
$url = $rutas->dameUrlBase().'/servidor/index.php?action=tareas';

// Ahora puede imprimirla sin error
echo "URL: " . $url . "<br>";

$json = file_get_contents($url);
echo "<pre>Respuesta JSON cruda:\n" . $json . "</pre>";

$registros = json_decode($json, true);
if ($registros === null) {
    echo "<p>Error al decodificar JSON: " . json_last_error_msg() . "</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<?php echo
$rutas->dameMenuInicio()."&nbsp;&nbsp;&nbsp;&nbsp;".$rutas->dameMenuNuevo(); ?>
<br>
<table border="1">
<thead>
<tr>
    <th>ID</th>
    <th>TÍTULO</th>
    <th>DESCRIPCIÓN</th>
    <th>PRIORIDAD</th>
    <th>OPCIONES</th>
</tr>
</thead>
<tbody>
<?php
            if (is_array($registros)) {
                foreach ($registros as $registro) {
                    echo "<tr>";
                    echo "<td>".$registro['id']."</td>";
                    echo "<td>".$registro['titulo']."</td>";
                    echo "<td>".$registro['descripcion']."</td>";
                    echo "<td>".$registro['prioridad']."</td>";
                    echo "<td>".$rutas->dameMenuModificar($registro['id'])."&nbsp;&nbsp;&nbsp;&nbsp;".$rutas->dameMenuEliminar($registro['id'])."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se recibieron registros válidos.</td></tr>";
            }
            ?>

</tbody>
</table>
</body>
</html>