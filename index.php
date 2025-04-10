<!DOCTYPE html> <!-- Define que el documento es HTML5 -->
<html lang="es"> <!-- Inicio del documento HTML con idioma español -->
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres UTF-8 -->
    <title>Calculadora de Fracciones</title> <!-- Título de la pestaña del navegador -->

    <!-- Estilos CSS embebidos -->
    <style>
        /* Estilo general del cuerpo de la página */
        body {
            font-family: Arial, sans-serif; /* Tipo de letra */
            background-color: #f4f4f4; /* Color de fondo */
            display: flex; /* Usamos Flexbox para centrar */
            justify-content: center; /* Centrado horizontal */
            align-items: center; /* Centrado vertical */
            height: 100vh; /* Altura de toda la ventana */
            margin: 0; /* Sin márgenes */
        }

        /* Contenedor principal del formulario */
        .container {
            background-color: #fff; /* Fondo blanco */
            padding: 30px; /* Espaciado interno */
            border-radius: 15px; /* Bordes redondeados */
            box-shadow: 0 8px 20px rgba(0,0,0,0.15); /* Sombra para dar profundidad */
            width: 400px; /* Ancho fijo del formulario */
        }

        /* Estilo para el título principal */
        h1 {
            text-align: center; /* Centrado del texto */
            color: #333; /* Color de texto */
            margin-bottom: 25px; /* Espacio debajo del título */
        }

        /* Estilo para subtítulos */
        h3 {
            margin-bottom: 10px; /* Espacio debajo del subtítulo */
            color: #555; /* Color gris oscuro */
        }

        /* Estilo para los campos numéricos */
        input[type="number"] {
            width: 45%; /* Que cada número ocupe casi la mitad del espacio */
            padding: 8px; /* Espaciado interno */
            margin: 5px 0; /* Espaciado vertical */
            border-radius: 8px; /* Bordes redondeados */
            border: 1px solid #ccc; /* Borde gris claro */
            text-align: center; /* Texto centrado */
        }

        /* Estilo para el menú desplegable */
        select {
            width: 100%; /* Ocupar todo el ancho disponible */
            padding: 10px; /* Espaciado interno */
            border-radius: 8px; /* Bordes redondeados */
            border: 1px solid #ccc; /* Borde gris claro */
            margin-bottom: 20px; /* Espacio debajo del select */
        }

        /* Estilo para el botón de envío */
        input[type="submit"] {
            background-color: #4CAF50; /* Color de fondo verde */
            color: white; /* Color del texto */
            padding: 12px; /* Espaciado interno */
            width: 100%; /* Ancho completo del contenedor */
            border: none; /* Sin borde */
            border-radius: 8px; /* Bordes redondeados */
            cursor: pointer; /* Cursor tipo "mano" */
            font-size: 16px; /* Tamaño de texto */
        }

        /* Estilo al pasar el mouse por encima del botón */
        input[type="submit"]:hover {
            background-color: #45a049; /* Verde un poco más oscuro */
        }
    </style>
</head>

<body> <!-- Cuerpo principal del documento -->

    <!-- Contenedor central del formulario -->
    <div class="container">
        <h1>Calculadora de Fracciones</h1> <!-- Título del formulario -->

        <!-- Formulario que envía los datos a procesar.php mediante POST -->
        <form action="procesar.php" method="post">

            <!-- Sección para ingresar la primera fracción -->
            <h3>Fracción 1</h3>
            <input type="number" name="ent1" placeholder="Entero" value="0">
            <input type="number" name="num1" required> / <!-- Numerador 1 -->
            <input type="number" name="den1" required>   <!-- Denominador 1 -->

            <!-- Sección para ingresar la segunda fracción -->
            <h3>Fracción 2</h3>
            <input type="number" name="ent2" placeholder="Entero" value="0">
            <input type="number" name="num2" required> / <!-- Numerador 2 -->
            <input type="number" name="den2" required>   <!-- Denominador 2 -->

            <!-- Selección de la operación matemática a realizar -->
            <h3>Operación</h3>
            <select name="operacion" required>
                <option value="sumar">Sumar</option> <!-- Opción de suma -->
                <option value="restar">Restar</option> <!-- Opción de resta -->
                <option value="multiplicar">Multiplicar</option> <!-- Multiplicación -->
                <option value="dividir">Dividir</option> <!-- División -->
            </select>

            <!-- Botón para enviar el formulario -->
            <input type="submit" value="Calcular">
        </form>
    </div>

</body>
</html>
