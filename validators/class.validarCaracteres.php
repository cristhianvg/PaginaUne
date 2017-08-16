<?php

class validarCaracteres implements IValidator{
  
  public function validate(string $value, array $params = array()): bool {
    $cntCaract = strlen($value);
    if($params['minimo'] <= $cntCaract and $cntCaract>= $params['maximo']){
      return true;
    }else{
      return false;
    }
  }

}