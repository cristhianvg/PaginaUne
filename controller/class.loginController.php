<?php

class login extends controller {

  public function main(\request $request) {
    $this->loadTable();

    $usuarioDAO = new usuarioDAO($this->getConfig());
    $password = hash($this->getConfig()->getHash(), $request->getParam('contrasena'));
    $data = $usuarioDAO->validarUsuarioContrasena($request->getParam('usuario'), $password);
    
    $array = array(
        'code' => (count($data) > 0) ? 200 : 300,
        'usuario' => (count($data) > 0) ? $data[0] : '',
        'mensaje' => (count($data) == 0) ? 'Datos de usuario inválidos' : ''
    );

    $this->setParam('rsp', $array);
    $this->setView('imprimirJSON');

//    $usuario = new usuario($this->getConfig()->getHash());
//    $usuario->setUsuario('julian');
//    $usuario->setContrasena('123');
//    $usuario->setRol_id('1');
//
//    $usuarioDAO = new usuarioDAO($this->getConfig());
//    $usuarioDAO->create($usuario);
//
//    $this->setParam('rsp', array());
//    $this->setView('imprimirJSON');
//
//    $usuarioDAO->delete(3, true);
//
//    $usuario->setId(2);
//    $usuarioDAO->update($usuario);
//
//    $data = $usuarioDAO->read();
  }

  private function loadTable() {
    require_once $this->getConfig()->getPath() . 'model/usuario/IUsuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuarioDAO.php';
  }

}
