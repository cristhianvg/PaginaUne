<?php

interface IUsuario {

  public function create(usuario $usuario);

  public function read();

  public function update(usuario $usuario);

  public function delete(int $id, bool $logical = false);
}
