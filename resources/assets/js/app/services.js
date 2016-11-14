
App.service('OFCIAPIService', function($http, $window) {
    this.API_URL = SITE_URL + '/api';
    this.handleError = function(response) {
      console.log('error', response);
      if (response.status == 401) {
          delete $window.localStorage.access_token;
      } else {
          return response.data;
      }
    };

    this.get = function (endpoint) {
      var promise = $http.get(this.API_URL + endpoint).then(
          function (response) {
              // success handler
              if (!response.data.code) {
                return response.data;
              } else {
                alert('API Call success, but data fails');
                return response.data;
              }
          },
          this.handleError
      );
      // Return the promise to the controller
      return promise;
    };

    this.post = function (endpoint, payload) {
      var promise = $http.post(this.API_URL + endpoint, payload).then(
        function (response) {
          // success handler
          if (response.data.s === 's') {
            return response.data;
          } else {
            // alert('API Call success, but data says fails');
            return response.data;
          }
        },
        this.handleError
      );
      // Return the promise to the controller
      return promise;
    };


});
