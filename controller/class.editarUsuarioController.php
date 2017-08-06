<?php

class editarUsuario extends controller {

  public function main(\request $request) {
    $this->loadTable();

    $usuario = new usuario($this->getConfig()->getHash());
    $usuario->setRol_id($request->getParam('rol_id'));
    $usuario->setUsuario($request->getParam('usuario'));
    $usuario->setContrasena($request->getParam('contrasena'));
    $usuario->setCedula($request->getParam('cedula'));
    $usuario->setId($request->getParam('id'));

    $usuarioDAO = new usuarioDAO($this->getConfig());
    $data = $usuarioDAO->update($usuario);
    
    $array = array(
        'code' => 200,
        'usuario' => $data,
        'mensaje' => 'Usuario modificado exitosamente'
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
