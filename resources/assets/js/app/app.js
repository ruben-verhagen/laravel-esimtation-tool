'use strict';

// Declare app level module which depends on views, and components
var App = angular.module('ofciApp', [
  // 'myApp.version',
  // 'ngAnimate',
  // 'ui.bootstrap',
], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

App.run(function($rootScope, $location) {

});
