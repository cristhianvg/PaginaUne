angular.module('myApp').controller('loginController', function ($scope, ajaxService, $log, $sessionStorage, $localStorage, $state) {

  // solo puede acceder quien no esté identificado
  if ((typeof $sessionStorage.usuario === "undefined" && typeof $localStorage.usuario !== "undefined") || (typeof $sessionStorage.usuario !== "undefined" && typeof $localStorage.usuario === "undefined")) {
    $state.go('index');
  }

  $scope.login = {
    recordarme: false
  };

  $('#modal').modal({
    keyboard: false,
    show: true,
    backdrop: 'static'
  });

  $scope.submit = function () {
    ajaxService.login($scope.login).then(function success(response) {
      let storage = '';
      if (response.data.code == 200) {
        switch ($scope.login.recordarme) {
          case true:
            storage = $localStorage;
            break;
          case false:
            storage = $sessionStorage;
            break;
        }
        storage.usuario = response.data.usuario;
        $state.go('index');
      } else if (response.data.code == 300) {
        $scope.login = {
          recordarme: false
        };
        $scope.mensajeError = response.data.mensaje;
      } else {
        $scope.login = {
          recordarme: false
        };
        $log.error(response.data.error);
      }
    }, function error(response) {
      $scope.login = {
        recordarme: false
      };
      $log.error(response);
    });
  };

});
