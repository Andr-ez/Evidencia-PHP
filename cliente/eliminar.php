<?php
require_once "Rutas.php";
$rutas = new Rutas();
$id = $_GET['id'];
$url = $rutas->dameUrlBase()."/servidor/index.php?action=tareas&id=".$id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$resultado = "No fue posible eliminar el registro";
if ($httpCode === 204 || $httpCode === 200) {
    $resultado = "Registro eliminado exitosamente";

    // Redirección automática después de 2 segundos
    header("Refresh: 2; URL=".$rutas->dameUrlBase()."/cliente/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar tarea</title>
</head>
<body>
    <?php echo $rutas->dameMenuInicio()."&nbsp;&nbsp;&nbsp;&nbsp;".$rutas->dameMenuNuevo(); ?>
    <br>
    <?php echo $resultado; ?>
</body>
</html>
