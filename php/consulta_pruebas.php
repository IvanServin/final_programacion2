<?php
include '../conexion/conexion.php';

?>

<link rel="stylesheet" href="../css/estilos_index.css">
<a href="../index.php">Volver</a>
<section id="consulta">
    <h2>Consulta de Equipos y Ciclistas</h2>
    <form id="consultaForm" action="consulta_pruebas.php" method="GET">
        <label for="prueba">Seleccionar prueba:</label>
        <select id="prueba" name="prueba" required>
            <?php
            
            include '../conexion/conexion.php';
            
            
            $sql = "SELECT id, nombre FROM pruebas"; 
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
            
            foreach ($resultados as $fila) {
                echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
            }
            ?>
        </select>
        <button type="submit">Consultar</button>
    </form>

    <div id="resultadosConsulta">
        <?php
        
        if (isset($_GET['prueba'])) {
            $pruebaId = $_GET['prueba'];

            $consultaCiclistas = $conexion->prepare("
                SELECT ciclistas.id, ciclistas.nombre 
                FROM pruebas_ciclistas
                JOIN ciclistas ON pruebas_ciclistas.ciclista_id = ciclistas.id
                WHERE pruebas_ciclistas.prueba_id = :prueba_id
            ");
            $consultaCiclistas->bindParam(':prueba_id', $pruebaId);
            $consultaCiclistas->execute();
            $ciclistas = $consultaCiclistas->fetchAll(PDO::FETCH_ASSOC);

        
            if ($ciclistas) {
                echo "<h3>Ciclistas asociados a la prueba:</h3>";
                echo "<ul>";
                foreach ($ciclistas as $ciclista) {
                    echo "<li>" . $ciclista['nombre'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No se encontraron ciclistas para esta prueba.</p>";
            }

  
            $consultaDetalles = $conexion->prepare("SELECT * FROM pruebas WHERE id = :prueba_id");
            $consultaDetalles->bindParam(':prueba_id', $pruebaId);
            $consultaDetalles->execute();
            $detallePrueba = $consultaDetalles->fetch(PDO::FETCH_ASSOC);

            if ($detallePrueba) {
                echo "<h3>Detalles de la prueba: " . $detallePrueba['nombre'] . "</h3>";
                echo "<p>Fecha: " . $detallePrueba['fecha'] . "</p>";
            } else {
                echo "<p>No se encontraron detalles para esta prueba.</p>";
            }
        }
        ?>
    </div>
</section>

