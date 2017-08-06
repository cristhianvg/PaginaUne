<?php

class getUsuarios extends controller {

  public function main(\request $request) {
    $this->loadTable();

    $usuarioDAO = new usuarioDAO($this->getConfig());
    $data = $usuarioDAO->read();
    
    $array = array(
        'code' => (count($data) > 0) ? 200 : 300,
        'usuarios' => (count($data) > 0) ? $data : '',
        'mensaje' => (count($data) == 0) ? 'No hay datos' : ''
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
