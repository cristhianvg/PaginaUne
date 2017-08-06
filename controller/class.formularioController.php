<?php

class formulario extends controller {

  public function main(\request $request) {

    $datos = array(
        'email' => array(
            'value' => ($request->hasParam('email')) ? $request->getParam('email') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'El correo es requerido'
            ),
            array(
                'type' => validate::EXISTS_IN_DATABASE,
                'answer' => false,
                'message' => 'El correo digitado ya existe'
            )
        ),
        'password1' => array(
            'value' => ($request->hasParam('password1')) ? $request->getParam('password1') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'La contraseña es requerida'
            )
        ),
        'password2' => array(
            'value' => ($request->hasParam('password2')) ? $request->getParam('password2') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'La contraseña es requerida'
            )
        )
    );

    $formulario = new validate($datos);

    if ($formulario->isValidate() === true) {

      $rsp = array(
          'code' => 200,
          'message' => 'Todo bien desde el servidor'
      );
    } else {
      $rsp = array(
          'code' => 300,
          'error' => $formulario->getError()
      );
    }

    $this->setParam('rsp', $rsp);
    $this->setView('imprimirJSON');
  }
}
