angular.module('myApp').controller('logoutController', ['$scope', '$sessionStorage', '$localStorage', '$state', function ($scope, $sessionStorage, $localStorage, $state) {
    $sessionStorage.$reset();
    $localStorage.$reset();
    $state.go('index');
  }]);
