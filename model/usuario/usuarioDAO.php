<?php

class usuarioDAO extends dataSource implements IUsuario {

  public function validarUsuarioContrasena($usuario, $contrasena) {
    $sql = 'SELECT usu_id, usu_cedula, usu_alias, usu_contrasena, usu_nombre, usu_telefono, usu_correo, rol_id FROM usuario WHERE usu_alias = :usu AND usu_contrasena = :pass';
    $params = array(
        ':usu' => $usuario,
        ':pass' => $contrasena
    );
    return $this->query($sql, $params);
  }

  public function create(\usuario $usuario) {
    $sql = 'INSERT INTO usuario (rol_id, usu_alias, usu_contrasena, usu_cedula, usu_nombre, usu_telefono, usu_correo) VALUES (:rol, :user, :pass, :cedula, :nombre, :telefono, :correo)';
    $params = array(
        ':rol' => $usuario->getRol_id(),
        ':user' => $usuario->getUsuario(),
        ':pass' => $usuario->getContrasena(),
        ':cedula' => $usuario->getCedula(),
        ':nombre' => $usuario->getNombre(),
        ':telefono' => $usuario->getTelefono(),
        ':correo' => $usuario->getCorreo(),
    );
    return $this->execute($sql, $params);
  }

  public function delete(int $id, bool $logical = false) {
    if ($logical === true) {
      $sql = 'UPDATE usuario SET usu_deleted_at = now() WHERE usu_id = :id';
    } else {
      $sql = 'DELETE usuario WHERE usu_id = :id';
    }
    $params = array(':id' => $id);
    return $this->execute($sql, $params);
  }

  public function read() {
    $sql = 'SELECT 
              usuario.usu_id, 
              usuario.usu_usuario, 
              usuario.usu_activo, 
              usuario.usu_created_at, 
              rol.rol_nombre
            FROM 
              public.usuario, 
              public.rol
            WHERE 
              rol.rol_id = usuario.rol_id
              AND usu_deleted_at IS NULL';
    return $this->query($sql);
  }

  public function update(\usuario $usuario) {
    $sql = 'UPDATE usuario SET usu_cedula = :cedula, usu_alias = :usuario, usu_contrasena = :contrasena, usu_nombre = :nombre, usu_telefono = :telefono, usu_correo = :correo, rol_id = :rol WHERE usu_id = :id AND usu_deleted_at IS NULL';
    $params = array(
        ':usuario' => $usuario->getUsuario(),
		':cedula' => $usuario->getCedula(),
		':contrasena' => $usuario->getContrasena($this->getConfig()->getHash()),
		':rol' => $usuario->getRol_id(),
		':nombre' => $usuario->getNombre(),
		':telefono' => $usuario->getTelefono(),
		':correo' => $usuario->getCorreo(),
		':id' => $usuario->getId()
    );
    return $this->execute($sql, $params);
  }

  public function cargarUsu() {
    $sql = 'SELECT usuario.usu_id, usuario.usu_cedula, usuario.usu_alias, usuario.usu_contrasena, usuario.usu_nombre, usuario.usu_telefono, usuario.usu_correo, rol.rol_nombre, usuario.usu_created_at FROM public.usuario, public.rol WHERE rol.rol_id = usuario.rol_id AND usuario.usu_deleted_at IS NULL';
    return $this->query($sql);
  }

}
