<?php
// Requiere el archivo de la clase Fraccion para utilizarla en este archivo
require_once 'Fraccion.php';

// Se crean dos instancias de la clase Fraccion con numerador y denominador
$f1 = new Fraccion(1, 2);  // Se crea la primera fracción 1/2
$f2 = new Fraccion(3, 4);  // Se crea la segunda fracción 3/4

// Muestra las fracciones originales en formato "numerador/denominador"
echo "Fracción 1: $f1\n";  // Imprime la representación de la primera fracción
echo "Fracción 2: $f2\n";  // Imprime la representación de la segunda fracción

// Se prueban las cuatro operaciones básicas de la clase Fraccion

// Realiza la suma de las dos fracciones y muestra el resultado
echo "Suma: " . $f1->sumar($f2) . "\n";  // Llama al método sumar y muestra el resultado

// Realiza la resta de las dos fracciones y muestra el resultado
echo "Resta: " . $f1->restar($f2) . "\n";  // Llama al método restar y muestra el resultado

// Realiza la multiplicación de las dos fracciones y muestra el resultado
echo "Multiplicación: " . $f1->multiplicar($f2) . "\n";  // Llama al método multiplicar y muestra el resultado

// Realiza la división de las dos fracciones y muestra el resultado
echo "División: " . $f1->dividir($f2) . "\n";  // Llama al método dividir y muestra el resultado
?>
