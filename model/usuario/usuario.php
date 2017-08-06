<?php

class usuario {

  private $id, $rol_id, $usuario, $contrasena, $cedula, $activo, $created_at, $deleted_at, $hash;

  public function __construct($hash) {
    $this->hash = $hash;
  }
  function getCedula() {
    return $this->cedula;
  }

  function setCedula($cedula) {
    $this->cedula = $cedula;
  }

  public function getId() {
    return $this->id;
  }

  public function getRol_id() {
    return $this->rol_id;
  }

  public function getUsuario() {
    return $this->usuario;
  }

  public function getContrasena() {
    return $this->contrasena;
  }

  public function getActivo() {
    return $this->activo;
  }

  public function getCreated_at() {
    return $this->created_at;
  }

  public function getDeleted_at() {
    return $this->deleted_at;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setRol_id($rol_id) {
    $this->rol_id = $rol_id;
  }

  public function setUsuario($usuario) {
    $this->usuario = $usuario;
  }

  public function setContrasena($contrasena) {
    $this->contrasena = hash($this->hash, $contrasena);
  }

  public function setActivo($activo) {
    $this->activo = $activo;
  }

  public function setCreated_at($created_at) {
    $this->created_at = $created_at;
  }

  public function setDeleted_at($deleted_at) {
    $this->deleted_at = $deleted_at;
  }

}
