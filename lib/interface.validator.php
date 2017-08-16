<?php

/**
 * Interfaz para los validadores personalizados
 */
interface IValidator {

  /**
   * Función principal para un validador personalizado
   * @param string $value
   * @param array $params
   * @return bool VERDADERO si cumple con la validación, FALSO si no cumple con la validación.
   */
  public function validate(string $value, array $params = array()): bool;
}
