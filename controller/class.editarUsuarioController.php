<?php

class editarUsuario extends controller {

  public function main(\request $request) {

    $datos = array(
        'cedula' => array(
            'value' => ($request->hasParam('cedula')) ? $request->getParam('cedula') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'La Cedula Es Obligatoria'
            ),
            array(
                'type' => validate::IS_NUMBER,
                'message' => 'Solo Se Permiten Numeros'
            )
        ),
        'usuario' => array(
            'value' => ($request->hasParam('usuario')) ? $request->getParam('usuario') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'El Usuario Es Obligatorio'
            ),
        ),
        'contrasena' => array(
            'value' => ($request->hasParam('contrasena')) ? $request->getParam('contrasena') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'La Contraseña Es Obligatoria'
            ),
//            array(
//                'type' => validate::CUSTOM,
//                'message' => 'La contraseña debe de tener minimo 4 caracteres y maximo 10 caracteres',
//                'params'=>array(
//                  'minimo' => 4,
//                  'maximo' => 10,
//                ),
//                'class' => 'validarCaracteres',
//                'files' => array(
//                $this->getConfig()->getPath() . 'validators/class.validarCaracteres.php'
//                )
//            ),
        ),
        'contrasena2' => array(
            'value' => ($request->hasParam('contrasena2')) ? $request->getParam('contrasena2') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'Confirmar La Contraseña Es Obligatorio'
            ),
            array(
                'type' => validate::IS_EQUAL,
                'message' => 'Las Contraseñas Son Diferentes',
                'otherValue' => $request->getParam('contrasena')
            ),
        ),
        'nombre' => array(
            'value' => ($request->hasParam('nombre')) ? $request->getParam('nombre') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'El Nombre Es Obligatorio'
            ),
        ),
        'telefono' => array(
            'value' => ($request->hasParam('telefono')) ? $request->getParam('telefono') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'El Telefono es Obligatorio'
            ),
            array(
                'type' => validate::IS_NUMBER,
                'message' => 'Solo Se Permiten Numeros'
            )
        ),
        'correo' => array(
            'value' => ($request->hasParam('correo')) ? $request->getParam('correo') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'El Correo Es Obligatorio'
            ),
            array(
                'type' => validate::IS_EMAIL,
                'message' => 'Debes Digitar Un Correo Valido'
            )
        ),
    );

    $formulario = new validate($datos);

    if ($formulario->isValidate() === true) {

      $this->loadTable();

      $usuario = new usuario($this->getConfig()->getHash());
      $usuario->setRol_id($request->getParam('rol_id'));
      $usuario->setUsuario($request->getParam('usuario'));
      $usuario->setContrasena($request->getParam('contrasena'));
      $usuario->setCedula($request->getParam('cedula'));
      $usuario->setNombre($request->getParam('nombre'));
      $usuario->setTelefono($request->getParam('telefono'));
      $usuario->setCorreo($request->getParam('correo'));
      $usuario->setId($request->getParam('id'));

      $usuarioDAO = new usuarioDAO($this->getConfig());
      $data = $usuarioDAO->update($usuario);


      $rsp = array(
          'code' => 200,
          'usuario' => $data,
          'mensaje' => 'Usuario modificado exitosamente'
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

  private function loadTable() {
    require_once $this->getConfig()->getPath() . 'model/usuario/IUsuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuarioDAO.php';
  }

}
