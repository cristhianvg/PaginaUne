//angular.module('myApp').constant('rolAdmin', {id: 1, rol: 'administrador'});
//angular.module('myApp').constant('rolCliente', {id: 2, rol: 'cliente'});

angular.module('myApp').config(function ($stateProvider, $urlRouterProvider, $locationProvider, $httpProvider) {
  $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
  $locationProvider.hashPrefix('');
  $urlRouterProvider.otherwise('/');
  $stateProvider.state('index', {
    url: '/',
    templateUrl: 'app/template/index.html',
    controller: 'indexController',
    resolve: {
      deps: ['$ocLazyLoad', function ($ocLazyLoad) {
          return $ocLazyLoad.load([
            {
              serie: true,
              files: [
                'app/controller/controller.index.js'
              ]
            }
          ]);
        }]
    }
  }).state('login', {
    url: '/login',
    templateUrl: 'app/template/login.html',
    controller: 'loginController',
    resolve: {
      deps: ['$ocLazyLoad', function ($ocLazyLoad) {
          return $ocLazyLoad.load([
            {
              serie: true,
              files: [
                'css/login.css',
                'app/service/service.ajax.js',
                'app/controller/controller.login.js'
              ]
            }
          ]);
        }]
    }
  }).state('logout', {
    url: '/logout',
    template: '',
    controller: 'logoutController',
    resolve: {
      deps: ['$ocLazyLoad', function ($ocLazyLoad) {
          return $ocLazyLoad.load([
            {
              serie: true,
              files: [
                'app/controller/controller.logout.js'
              ]
            }
          ]);
        }]
    }
  }).state('gestionUsuarios', {
    url: '/usuarios',
    templateUrl: 'app/template/usuariosGestion.html',
    controller: 'gestionUsuariosController',
    resolve: {
      deps: ['$ocLazyLoad', function ($ocLazyLoad) {
          return $ocLazyLoad.load([
            {
              serie: true,
              files: [
                'app/service/service.ajax.js',
                'app/controller/controller.gestionUsuarios.js'
              ]
            }
          ]);
        }]
    }
  }).state('simulador', {
    url: '/simulador',
    templateUrl: 'app/template/simulador.html',
    controller: 'simuladorController',
    resolve: {
      deps: ['$ocLazyLoad', function ($ocLazyLoad) {
          return $ocLazyLoad.load([
            {
              serie: true,
              files: [
                'app/controller/controller.simulador.js'
              ]
            }
          ]);
        }]
    }
  })
});