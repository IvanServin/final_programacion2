<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ciclistas</title>
    <link rel="stylesheet" href="css/estilos_index.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>Gestión de Ciclistas</h1>
        <nav>
            <ul>
                <li><a href="php/abm_ciclistas.php">ABM Ciclistas</a></li>
                <li><a href="php/consulta_pruebas.php">Consulta de Pruebas</a></li>
                <li><a href="#estadisticas">Estadísticas</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="estadisticas">
            <h2>Estadísticas</h2>
            <canvas id="graficoEstadisticas"></canvas>
        </section>
    </main>

</body>
</html>
