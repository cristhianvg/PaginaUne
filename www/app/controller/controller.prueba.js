angular.module('myApp').controller('pruebaController', function ($scope, $sessionStorage, $localStorage, $state, ajaxService) {

  if (typeof $sessionStorage.usuario === "undefined" && typeof $localStorage.usuario === "undefined") {
    $state.go('login');
  }

  $scope.uno = 'active';
  $scope.usuarioNuevo = {};
  $scope.usuarios = [];
  $scope.edit = {};
  $scope.error = {};

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

  $scope.submitAgregarPrueba = function () {
    ajaxService.nuevoUsuarioPrueba($scope.usuarioNuevo).then(function success(response) {
      if (response.data.code === 200) {
        $scope.error = {};
        console.log('Todo BIEN');
        $state.go('gestionUsuarios', {}, {reload: true});
        $('div[class="modal-backdrop fade in"]').remove();
        location.reload();
      } else if (response.data.code === 300) {
        $scope.error = response.data.error;
      } else if (response.data.code === 500) {
        console.error(response);
      }
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
