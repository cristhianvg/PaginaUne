angular.module('myApp').service('ajaxService', function ($http) {

  this.login = function (data) {
    return $http.post('http://localhost/PaginaUne/www/server.php/login', $.param(data));
  };

  this.obtenerUsu = $http.post('http://localhost/PaginaUne/www/server.php/obtener');

  this.nuevoUsuario = function (data) {
    return $http.post('http://localhost/PaginaUne/www/server.php/nuevoUsuario', $.param(data));
  };
  
  this.eliminarUsu = function (data) {
    return $http.post('http://localhost/PaginaUne/www/server.php/borrarUsuario', $.param(data));
  };
  
  this.editarUsu = function (data) {
    return $http.post('http://localhost/PaginaUne/www/server.php/editarUsuario', $.param(data));
  };

});

