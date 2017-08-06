<?php

/**
 * Clase para realizar validaciones en formularios o similares
 */
class validate {

  const IS_NUMBER = 0;
  const IS_NULL = 1;
  const IS_NOT_NULL = 2;
  const EXISTS_IN_DATABASE = 3;

  /**
   * 
   * @var string
   */
  private $form;

  /**
   * 
   * @var array
   */
  private $error = array();

  public function __construct($form) {
    $this->form = $form;
  }

  /**
   * 
   * @return array
   */
  public function getError(): array {
    return $this->error;
  }

  /**
   * 
   * @param string $input
   * @param string $message
   */
  public function setError(string $input, string $message) {
    $this->error[$input]['message'] = $message;
  }

  /**
   * 
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

          // IS_NULL
          case 1:
            if (strlen($validations['value']) > 0) {
              $flag = false;
              $flagCnt++;
            }
            break;

          // IS_NOT_NULL
          case 2:
            if (is_null($validations['value']) === true or $validations['value'] === '') {
              $flag = false;
              $flagCnt++;
            }
            break;

          // EXISTS_IN_DATABASE
          case 3:
            if ($validations[$x]['answer'] === true) {
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
