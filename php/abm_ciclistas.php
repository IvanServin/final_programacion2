<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $equipo_id = $_POST['equipo'];

    $sql = "INSERT INTO ciclistas (nombre, edad, equipo_id) VALUES (:nombre, :edad, :equipo_id)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':edad', $edad);
    $stmt->bindParam(':equipo_id', $equipo_id);

    if ($stmt->execute()) {
        echo "Ciclista agregado correctamente.";
    } else {
        echo "Error al agregar ciclista.";
    }
}
?>
<link rel="stylesheet" href="../css/estilos_index.css">
<a href="../index.php">volver</a>
<section id="abm">
    <h2>ABM de Ciclistas</h2>
    <form id="abmForm" action="abm_ciclistas.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>

        <label for="equipo">Seleccionar equipo:</label>
        <select id="equipo" name="equipo" required>
            <?php
            include '../conexion/conexion.php';
            $sql = "SELECT id,nombre FROM equipos";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


            foreach ($resultados as $fila) {
                echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
            }
            ?>
        </select>

        <button type="submit">Guardar</button>
    </form>

    <div id="listadoCiclistas">

    </div>
</section>