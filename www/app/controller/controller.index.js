angular.module('myApp').controller('indexController', function ($scope, $sessionStorage, $localStorage, $state) {

  $('div[class="modal-backdrop fade in"]').remove();

  // seguridad solo si no tiene identificación
  if (typeof $sessionStorage.usuario === "undefined" && typeof $localStorage.usuario === "undefined") {
    $state.go('login');
  }

  //$scope.uno = 'active';

});
