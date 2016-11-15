

App.controller('AppCtrl', ['$scope', '$window', '$location', function($scope, $window, $location) {
  console.log('AppCtrl');
}]);

App.controller('EstimationCtrl', ['$scope', '$window', '$location', 'OFCIAPIService', function($scope, $window, $location, OFCIAPIService) {

  $scope.spaces = [];
  $scope.item_options = [];
  $scope.total_price = 0;

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
    });
  };

  $scope.setPrice = function(item) {
    var found = $.grep($scope.item_options, function( it, i ) {
      return it.id === item.obj.id;
    });
    item.price = found.length > 0 ? parseFloat(found[0].price) : 0;
    $scope.calc_total();
  };

  $scope.removeItem = function(space, item) {
    space.items.splice(space.items.indexOf(item), 1);
  };

  $scope.calc_total = function() {
    var total = 0;
    angular.forEach($scope.spaces, function(space, key) {
      angular.forEach(space.items, function(item, key) {
        total += item.price * space.size_x * space.size_y;
      });
    });
    $scope.total_price = total.toFixed(2);
  };

  $scope.saveEstimation = function() {
    if ($scope.total_price == 0) {
      alert('No estimation details found.');
      return false;
    }
    var payload = {
      spaces: $scope.spaces
    };
    OFCIAPIService.post('/saveEstimation', payload).then(function(response) {
      location.href = SITE_URL + "/estimations/" + response.estimation_id;
    });
  };

  $scope.init();
}]);


App.controller('EstimationViewCtrl', ['$scope', '$window', '$location', 'OFCIAPIService', function($scope, $window, $location, OFCIAPIService) {

  $scope.spaces = [];
  $scope.item_options = [];
  $scope.total_price = 0;

  $scope.spacesLoaded = false;

  $scope.init = function(estimationId) {
    $scope.estimationId = estimationId;
    OFCIAPIService.get('/estimations/' + $scope.estimationId).then(function(response) {
      $scope.estimation = response.estimation;
      $scope.calc_total();
    });
  };

  $scope.calc_total = function() {
    var total = 0;
    angular.forEach($scope.estimation.spaces, function(space, key) {
      angular.forEach(space.items, function(item, key) {
        total += item.price * space.size_x * space.size_y;
      });
    });
    $scope.total_price = total.toFixed(2);
  };

  $scope.save = function() {
    OFCIAPIService.put('/estimations/' + $scope.estimationId, $scope.estimation).then(function(response) {
      if (response && response.result) {
        alert('The invoice is successfully sent to the customer');
        location.href = response.path;
      } else {
        alert('The invoice is NOT successfully sent.');
      }
    });
  };

}]);
