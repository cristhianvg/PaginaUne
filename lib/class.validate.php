<?php

/**
 * Clase para realizar validaciones en formularios o similares
 */
class validate {

  /**
   * Validación del tipo ¿el valor será numérico?
   */
  const IS_NUMBER = 0;

  /**
   * Validación del tipo ¿el valor principal será igual al valor secundario?
   */
  const IS_EQUAL = 1;

  /**
   * Validación del tipo ¿el valor principal no es igual al valor secundario?
   */
  const IS_NOT_EQUAL = 2;

  /**
   * Validación por medio de una expresión regular
   */
  const PATTERN = 3;

  /**
   * Validación de un correo electrónico
   */
  const IS_EMAIL = 4;

  /**
   * Validación del tipo ¿el valor princial es nulo?
   */
  const IS_NULL = 5;

  /**
   * Validación del tipo ¿el valor principal no será nulo?
   */
  const IS_NOT_NULL = 6;

  /**
   * Validación del tipo ¿el valor existe en base de datos?
   */
  const EXISTS_IN_DATABASE = 7;

  /**
   * Validación personalizada
   */
  const CUSTOM = 8;

  /**
   * Variable contenedora de la configuración para realizar las validaciones
   * @var string
   */
  private $form;

  /**
   * Variable recolectora de los errores presentados para la configuración de validación
   * @var array
   */
  private $error = array();

  public function __construct($form) {
    $this->form = $form;
  }

  /**
   * Método para obtener el array de errores
   * @return array
   */
  public function getError(): array {
    return $this->error;
  }

  /**
   * Método para setear un error a un input determinado
   * @param string $input
   * @param string $message
   */
  public function setError(string $input, string $message) {
    $this->error[$input]['message'] = $message;
  }

  /**
   * Método principal para realizar la validación, el cual devolverá VERDADERO si la validación pasó totalmente o de lo contrario, devolverá FALSO
   * @return bool
   */
  public function isValidate(): bool {
    $flagCnt = 0;
    foreach ($this->form as $input => $validations) {
      $cnt = count($validations) - 1;
      for ($x = 0; $x < $cnt; $x++) {
        $flag = true;
        switch ($validations[$x]['type']) {

          // IS_NUMBER
          case 0:
            if (is_numeric($validations['value']) === false) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // IS_EQUAL
          case 1:
            if (!($validations['value'] == $validations[$x]['otherValue'])) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // IS_NOT_EQUAL
          case 2:
            if ($validations['value'] == $validations[$x]['otherValue']) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // PATTERN
          case 3:
            if (!preg_match($validations[$x]['pattern'], $validations['value'])) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // IS_EMAIL
          case 4:
            if (filter_var($validations['value'], FILTER_VALIDATE_EMAIL) === false) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // IS_NULL
          case 5:
            if (strlen($validations['value']) > 0) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // IS_NOT_NULL
          case 6:
            if (is_null($validations['value']) === true or $validations['value'] === '') {
              $flag = false;
              $flagCnt++;
            }
            break;

          // EXISTS_IN_DATABASE
          case 7:
            if ($validations[$x]['answer'] === true) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // CUSTOM
          case 8:
            if (isset($validations[$x]['files']) and is_array($validations[$x]['files']) and count($validations[$x]['files']) > 0) {
              foreach ($validations[$x]['files'] as $file) {
                require_once $file;
              }
            }
            $class = new $validations[$x]['class']();
            if ($class->validate($validations['value'], (isset($validations[$x]['params'])) ? $validations[$x]['params'] : array()) === false) {
              $flag = false;
              $flagCnt++;
            }
            break;
        }
        if (!$flag) {
          $this->setError($input, $validations[$x]['message']);
          break;
        }
      }
    }
    return $flagCnt > 0 ? false : true;
  }

}
