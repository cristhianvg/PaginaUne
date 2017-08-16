<?php

class nuevoUsuarioPrueba extends controller {

  public function main(\request $request) {

    $datos = array(
        'cedula' => array(
            'value' => ($request->hasParam('cedula')) ? $request->getParam('cedula') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'La cedula es Obligatoria'
            ),
            array(
                'type' => validate::IS_NUMBER,
                'message' => 'Solo se permiten numeros'
            )
        ),
        'usuario' => array(
            'value' => ($request->hasParam('usuario')) ? $request->getParam('usuario') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'El Usuario es Obligatorio'
            ),
        ),
        'contrasena' => array(
            'value' => ($request->hasParam('contrasena')) ? $request->getParam('contrasena') : null,
            array(
                'type' => validate::IS_NOT_NULL,
                'message' => 'La contraseña es Obligatoria'
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
                'message' => 'Confirmar la contraseña es Obligatorio'
            ),
            array(
                'type' => validate::IS_EQUAL,
                'message' => 'Las Contraseñas son Diferentes',
                'otherValue' => $request->getParam('contrasena')
            ),
        ),
    );

    $formulario = new validate($datos);

    if ($formulario->isValidate() === true) {

      $this->loadTable();

      $usuario = new usuario($this->getConfig()->getHash());
      $usuario->setRol_id($request->getParam('rol_id'));
      $usuario->setUsuario($request->getParam('usuario'));
      $usuario->setContrasena($request->getParam('contrasena'), $this->getConfig()->getHash());
      $usuario->setCedula($request->getParam('cedula'));

      $usuarioDAO = new usuarioDAO($this->getConfig());
      $data = $usuarioDAO->create($usuario);


      $rsp = array(
          'code' => 200,
          'usuarios' => $data,
          'mensaje' => 'Usuario creado exitosamente'
      );

//      $rsp = array(
//        'code' => 200,
//        'message' => 'todo bien desde el servidor'
//      );
    } else {
      $rsp = array(
          'code' => 300,
          'error' => $formulario->getError()
      );
    }

    $this->setParam('rsp', $rsp);
    $this->setView('imprimirJSON');
  }

//  public function main(\request $request) {
//    $this->loadTable();
//
//    $usuario = new usuario($this->getConfig()->getHash());
//    $usuario->setRol_id($request->getParam('rol_id'));
//    $usuario->setUsuario($request->getParam('usuario'));
//    $usuario->setContrasena($request->getParam('contrasena'), $this->getConfig()->getHash());
//    $usuario->setCedula($request->getParam('cedula'));
//
//    $usuarioDAO = new usuarioDAO($this->getConfig());
//    $data = $usuarioDAO->create($usuario);
//    
//    $array = array(
//        'code' => 200,
//        'usuarios' => $data,
//        'mensaje' => 'Usuario creado exitosamente'
//    );
//
//    $this->setParam('rsp', $array);
//    $this->setView('imprimirJSON');
//  }
//
  private function loadTable() {
    require_once $this->getConfig()->getPath() . 'model/usuario/IUsuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuarioDAO.php';
  }

}
