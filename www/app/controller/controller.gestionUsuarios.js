angular.module('myApp').controller('gestionUsuariosController', function ($scope, $sessionStorage, $localStorage, $state, ajaxService) {

  if (typeof $sessionStorage.usuario === "undefined" && typeof $localStorage.usuario === "undefined") {
    $state.go('login');
  }

  $scope.cero = 'active';
  $scope.usuarioNuevo = {};
  $scope.usuarios = [];
  $scope.edit = {};

//  ajaxService.getUsuarios.then(function success(response) {
//    $scope.usuarios = response.data.usuarios;
//  }, function error(response) {
//    console.log(response);
//  });

  $scope.pintarTablaUsu = function () {
    ajaxService.obtenerUsu.then(function successCallback(response) {
      switch (response.data.code) {
        case 200:
          $scope.usuarios = response.data.datos;
          break;
        case 500:
          $scope.usuarios = [];
      }
    });
  };

  $scope.pintarTablaUsu();

  $scope.submitAgregar = function () {
    ajaxService.nuevoUsuario($scope.usuarioNuevo).then(function success(response) {
      $state.go('gestionUsuarios', {}, {reload: true});
      $('div[class="modal-backdrop fade in"]').remove();
      location.reload();
    }, function error(response) {
      console.error(response);
    });
  };

  $scope.editar = function (dato) {
    $('#modalEditar').modal('toggle');
    $scope.edit.id = dato.usu_id;
    $scope.edit.cedula = dato.usu_cedula;
    $scope.edit.usuario = dato.usu_alias;
  };
  
  $scope.submitEditar = function () {
    ajaxService.editarUsu($scope.edit).then(function success(response) {
      $state.go('gestionUsuarios', {}, {reload: true});
      $('div[class="modal-backdrop fade in"]').remove();
      //location.reload();
    }, function error(response) {
      console.error(response);
    });
  };

  $scope.eliminar = function (dato) {
    $('#modalEliminarUsuario').modal('toggle');
    $scope.alias = dato.usu_alias;
    $scope.ideliminar = dato.usu_id;
  };

  $scope.submitEliminar = function () {
    ajaxService.eliminarUsu({id: $scope.ideliminar}).then(function success(response) {
      $state.go('gestionUsuarios', {}, {reload: true});
      $('div[class="modal-backdrop fade in"]').remove();
      location.reload();
    }, function error(response) {
      console.error(response);
    });
  };

});
