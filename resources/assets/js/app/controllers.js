

App.controller('AppCtrl', ['$scope', '$window', '$location', function($scope, $window, $location) {
  console.log('AppCtrl');
}]);


App.controller('EstimationCtrl', ['$scope', '$window', '$location', 'OFCIAPIService', function($scope, $window, $location, OFCIAPIService) {

  $scope.spaces = [];
  $scope.item_options = [];

  $scope.spacesLoaded = false;
  $scope.init = function() {
    OFCIAPIService.get('/space').then(function(response) {
      $scope.space_defaults = response.data;
      $scope.spacesLoaded = true;

      $scope.addSpace();
      $scope.addSpace();
    });

    OFCIAPIService.get('/item').then(function(response) {
      $scope.item_options = response.data;
    });
  };

  $scope.addSpace = function() {
    $scope.spaces.push({
      name: 'Space ' + ($scope.spaces.length + 1),
      size_x: 0,
      size_y: 0,
      items: [{ price: 0 }, { price: 0 }]
    });
  };

  $scope.removeSpace = function(space) {
    $scope.spaces.splice($scope.spaces.indexOf(space), 1);
  };

  $scope.addItem = function(space) {
    space.items.push({
      price: 0
    })
  };

  $scope.setPrice = function(item) {
    var found = $.grep($scope.item_options, function( it, i ) {
      return it.id === item.obj.id;
    });
    item.price = found.length > 0 ? parseFloat(found[0].price) : 0;
  };

  $scope.removeItem = function(space, item) {
    space.items.splice(space.items.indexOf(item), 1);
  };

  $scope.saveEstimation = function() {
    console.log($scope.spaces);
  };
  $scope.init();

}]);
