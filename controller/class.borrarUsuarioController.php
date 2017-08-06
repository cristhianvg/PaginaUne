<?php

class borrarUsuario extends controller {

  public function main(\request $request) {
    $this->loadTable();

    $usuarioDAO = new usuarioDAO($this->getConfig());
    $data = $usuarioDAO->delete($request->getParam('id'), true);
    
    $array = array(
        'code' => 200,
        'usuario' => $data,
        'mensaje' => 'Usuario fue borrado exitosamente'
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
