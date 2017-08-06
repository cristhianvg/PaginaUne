<?php

class nuevoUsuario extends controller {

  public function main(\request $request) {
    $this->loadTable();

    $usuario = new usuario($this->getConfig()->getHash());
    $usuario->setRol_id($request->getParam('rol_id'));
    $usuario->setUsuario($request->getParam('usuario'));
    $usuario->setContrasena($request->getParam('contrasena'), $this->getConfig()->getHash());
    $usuario->setCedula($request->getParam('cedula'));

    $usuarioDAO = new usuarioDAO($this->getConfig());
    $data = $usuarioDAO->create($usuario);
    
    $array = array(
        'code' => 200,
        'usuarios' => $data,
        'mensaje' => 'Usuario creado exitosamente'
    );

    $this->setParam('rsp', $array);
    $this->setView('imprimirJSON');
  }

  private function loadTable() {
    require_once $this->getConfig()->getPath() . 'model/usuario/IUsuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuario.php';
    require_once $this->getConfig()->getPath() . 'model/usuario/usuarioDAO.php';
  }

}
