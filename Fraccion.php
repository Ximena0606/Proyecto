<?php

// Definición de la clase Fraccion
class Fraccion {
    // Atributos privados para proteger la integridad de los datos
    private int $numerador;   // Atributo para almacenar el numerador de la fracción
    private int $denominador; // Atributo para almacenar el denominador de la fracción

    // Constructor que inicializa una fracción y la simplifica
    public function __construct(int $numerador, int $denominador) {
        // Validación de que el denominador no sea cero, ya que no se puede dividir entre cero
        if ($denominador == 0) {
            throw new Exception("El denominador no puede ser cero.");  // Lanza una excepción si el denominador es cero
        }
        $this->numerador = $numerador;  // Asigna el valor del numerador al atributo numerador
        $this->denominador = $denominador;  // Asigna el valor del denominador al atributo denominador
        $this->simplificar();  // Llama al método para simplificar la fracción automáticamente
    }

/**
 * Convierte una fracción mixta (parte entera, numerador y denominador) a una fracción impropia.
 *
 * Este método toma una fracción mixta representada por una parte entera, un numerador y un denominador,
 * y la convierte en una fracción impropia, de la forma:
 *   fracción impropia = (parte entera * denominador) + numerador
 *
 * Si el numerador o la parte entera son negativos, la fracción resultante será negativa.
 *
 * @param int $entero La parte entera de la fracción mixta (puede ser negativa).
 * @param int $numerador El numerador de la fracción mixta (puede ser negativo).
 * @param int $denominador El denominador de la fracción mixta.
 *
 * @return Fraccion Una nueva instancia de la clase Fraccion que representa la fracción impropia.
 * 
 * @throws Exception Si el denominador es igual a cero, se lanza una excepción, ya que no se puede dividir entre cero.
 */
public static function desdeMixta(int $entero, int $numerador, int $denominador): Fraccion {
    // Determina el signo de la fracción, si la parte entera o el numerador son negativos
    $signo = ($entero < 0 || $numerador < 0) ? -1 : 1;

    // Se asegura de trabajar con valores absolutos para la conversión
    $entero = abs($entero);
    $numerador = abs($numerador);

    // Calcula el numerador impropio sumando la parte entera multiplicada por el denominador y el numerador
    $num = $entero * $denominador + $numerador;

    // Retorna una nueva fracción impropia con el signo correspondiente y el denominador dado
    return new Fraccion($signo * $num, $denominador);
}


    // Método getter para obtener el numerador
    public function getNumerador(): int {
        return $this->numerador;  // Retorna el valor del numerador
    }

    // Método getter para obtener el denominador
    public function getDenominador(): int {
        return $this->denominador;  // Retorna el valor del denominador
    }

    // Método setter para modificar el numerador
    public function setNumerador(int $numerador): void {
        $this->numerador = $numerador;  // Asigna el nuevo valor al numerador
        $this->simplificar();  // Simplifica la fracción después de cambiar el numerador
    }

    // Método setter para modificar el denominador
    public function setDenominador(int $denominador): void {
        // Validación de que el denominador no sea cero antes de asignar el valor
        if ($denominador == 0) {
            throw new Exception("El denominador no puede ser cero.");  // Lanza una excepción si el denominador es cero
        }
        $this->denominador = $denominador;  // Asigna el nuevo valor al denominador
        $this->simplificar();  // Simplifica la fracción después de cambiar el denominador
    }

    // Método mágico __toString para representar la fracción como una cadena "a/b"
    public function __toString(): string {
        return "{$this->numerador}/{$this->denominador}";  // Retorna la fracción en formato "numerador/denominador"
    }

    public function aMixta(): string {
        $entero = intdiv($this->numerador, $this->denominador);
        $resto = abs($this->numerador % $this->denominador);
        if ($resto === 0) {
            return "$entero";
        } elseif ($entero === 0) {
            return "$resto/{$this->denominador}";
        }
        return "$entero $resto/{$this->denominador}";
    }

    // Método para simplificar la fracción usando el MCD (Máximo Común Divisor)
    public function simplificar(): void {
        // Calculamos el MCD de los valores absolutos del numerador y denominador
        $mcd = $this->mcd(abs($this->numerador), abs($this->denominador));
        // Dividimos el numerador y denominador por el MCD para simplificar la fracción
        $this->numerador /= $mcd;
        $this->denominador /= $mcd;

        // Si el denominador es negativo, convertimos la fracción a una forma estándar con denominador positivo
        if ($this->denominador < 0) {
            $this->numerador *= -1;  // Cambiamos el signo del numerador
            $this->denominador *= -1;  // Cambiamos el signo del denominador
        }
    }

    // Método privado para calcular el Máximo Común Divisor (MCD) usando el algoritmo de Euclides
    private function mcd(int $a, int $b): int {
        // Algoritmo de Euclides para calcular el MCD
        return $b == 0 ? $a : $this->mcd($b, $a % $b);  // Llamada recursiva hasta encontrar el MCD
    }

    // Operación de suma entre fracciones
    public function sumar(Fraccion $otra): Fraccion {
        // Calculamos el numerador y denominador del resultado de la suma
        $num = $this->numerador * $otra->getDenominador() + $otra->getNumerador() * $this->denominador;
        $den = $this->denominador * $otra->getDenominador();
        // Creamos una nueva fracción con el resultado y la simplificamos
        return new Fraccion($num, $den); 
    }

    // Operación de resta entre fracciones
    public function restar(Fraccion $otra): Fraccion {
        // Calculamos el numerador y denominador del resultado de la resta
        $num = $this->numerador * $otra->getDenominador() - $otra->getNumerador() * $this->denominador;
        $den = $this->denominador * $otra->getDenominador();
        // Creamos una nueva fracción con el resultado y la simplificamos
        return new Fraccion($num, $den);
    }

    // Operación de multiplicación entre fracciones
    public function multiplicar(Fraccion $otra): Fraccion {
        // Calculamos el numerador y denominador del resultado de la multiplicación
        return new Fraccion(
            $this->numerador * $otra->getNumerador(),
            $this->denominador * $otra->getDenominador()
        );  // Creamos una nueva fracción con el resultado y la simplificamos automáticamente
    }

    // Operación de división entre fracciones
    public function dividir(Fraccion $otra): Fraccion {
        // Validación para evitar dividir entre una fracción cuyo numerador sea cero
        if ($otra->getNumerador() == 0) {
            throw new Exception("No se puede dividir entre una fracción con numerador 0.");  // Lanza una excepción si el numerador es cero
        }
        // Calculamos el numerador y denominador del resultado de la división
        return new Fraccion(
            $this->numerador * $otra->getDenominador(),
            $this->denominador * $otra->getNumerador()
        );  // Creamos una nueva fracción con el resultado y la simplificamos automáticamente
    }
}
?>
