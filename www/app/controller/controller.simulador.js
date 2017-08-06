angular.module('myApp').controller('simuladorController', function ($scope, $sessionStorage, $localStorage, $state, ajaxService) {

  if (typeof $sessionStorage.usuario === "undefined" && typeof $localStorage.usuario === "undefined") {
    $state.go('login');
  }

  $scope.fecha = {};
  $scope.cinco = 'active';
});