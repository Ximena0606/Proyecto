<?php
// Activar la visualización de errores (útil para depuración durante desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir la clase Fraccion
require_once("Fraccion.php");

// Inicia el HTML y CSS embebido para darle estilo a la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Definimos la codificación de caracteres -->
    <title>Resultado</title> <!-- Título de la página -->
    <style>
        /* Estilos CSS para la página */
        body {
            font-family: "Segoe UI", sans-serif; /* Fuente para la página */
            background: #f2f2f2; /* Fondo gris claro */
            display: flex; /* Usamos Flexbox para organizar los elementos */
            flex-direction: column; /* Disposición de los elementos en columna */
            align-items: center; /* Centramos los elementos */
            padding: 50px; /* Espaciado alrededor */
        }
        .resultado-container {
            background-color: white; /* Fondo blanco para el contenedor */
            padding: 30px; /* Espaciado interno */
            border-radius: 12px; /* Bordes redondeados */
            box-shadow: 0 8px 16px rgba(0,0,0,0.1); /* Sombra suave */
            text-align: center; /* Alineación del texto */
            max-width: 400px; /* Ancho máximo del contenedor */
            width: 100%; /* Ancho completo */
        }
        h1 {
            color: #4CAF50; /* Color verde para el título */
        }
        .resultado {
            font-size: 28px; /* Tamaño grande para el resultado */
            font-weight: bold; /* Texto en negrita */
            color: #333; /* Color gris oscuro */
            margin: 20px 0; /* Espaciado vertical */
        }
        .resultado-dual {
    font-size: 20px;
    color: #333;
    margin-top: 15px;
}

/* Título pequeño para distinguir los tipos de resultado */
.resultado-dual span.label {
    display: block;
    font-weight: bold;
    color: #666;
    margin-top: 10px;
}
        a {
            text-decoration: none; /* Sin subrayado en el enlace */
            background-color: #4CAF50; /* Fondo verde */
            color: white; /* Texto blanco */
            padding: 10px 20px; /* Espaciado interno */
            border-radius: 8px; /* Bordes redondeados */
            display: inline-block; /* Hace que el enlace se vea como un botón */
            margin-top: 20px; /* Espaciado superior */
            transition: background 0.3s ease; /* Transición suave en el color */
        }
        a:hover {
            background-color: #388E3C; /* Cambio de color en el hover */
        }
    </style>
</head>
<body>
<div class="resultado-container">

<?php
// Verificamos que todos los datos del formulario hayan sido enviados
if (isset($_POST["num1"], $_POST["den1"], $_POST["num2"], $_POST["den2"], $_POST["operacion"])) {

    $ent1 = (int) ($_POST["ent1"] ?? 0);
    $ent2 = (int) ($_POST["ent2"] ?? 0);

    // Validar que ningún denominador sea cero
    if ($_POST["den1"] == 0 || $_POST["den2"] == 0) {
        echo "<h1>Error</h1>"; // Título del mensaje de error
        echo "<div class='resultado'>El denominador no puede ser cero.</div>"; // Mensaje de error
    } else {
        try {
            // Crear dos objetos Fraccion con los datos del formulario
            $f1 = Fraccion::desdeMixta($ent1, (int)$_POST["num1"], (int)$_POST["den1"]);
            $f2 = Fraccion::desdeMixta($ent2, (int)$_POST["num2"], (int)$_POST["den2"]);
            $resultado = null;

            // Ejecutar la operación seleccionada
            switch ($_POST["operacion"]) {
                case "sumar":
                    $resultado = $f1->sumar($f2); // Llamada a la operación de suma
                    break;
                case "restar":
                    $resultado = $f1->restar($f2); // Llamada a la operación de resta
                    break;
                case "multiplicar":
                    $resultado = $f1->multiplicar($f2); // Llamada a la operación de multiplicación
                    break;
                case "dividir":
                    $resultado = $f1->dividir($f2); // Llamada a la operación de división
                    break;
                default:
                    echo "<h1>Error</h1>"; // Título del mensaje de error
                    echo "<div class='resultado'>Operación no válida.</div>"; // Mensaje de error
                    exit;
            }

            // Mostrar el resultado final simplificado
            echo "<h1>Resultado</h1>"; // Título del resultado
            // Aquí usamos directamente el objeto $resultado que invoca __toString automáticamente
            echo "<div class='resultado'>" . $resultado . "</div>"; // Mostrar el resultado
            echo "<h1>Fracción mixta</h1>"; // Título del resultado
            echo "<div class='resultado'>" . $resultado->aMixta() . "</div>";

        } catch (Exception $e) {
            // Capturar y mostrar cualquier error
            echo "<h1>Error</h1>"; // Título del mensaje de error
            echo "<div class='resultado'>" . $e->getMessage() . "</div>"; // Mensaje del error
        }
    }

} else {
    // En caso de que falten datos del formulario
    echo "<h1>Error</h1>"; // Título del mensaje de error
    echo "<div class='resultado'>Faltan datos del formulario.</div>"; // Mensaje de error
}

// Botón para regresar al formulario
echo "<a href='index.php'>Volver al formulario</a>"; // Enlace para regresar

// Cierre del contenedor y del HTML
echo '
</div>
</body>
</html>
';
?>
