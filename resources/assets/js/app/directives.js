
App.directive('autocomplSpace', function ($compile) {
    return {
        link: function (scope, element) {
            var space_names = scope.space_defaults.map(function(item){
              return item.name;
            });
            $( element ).autocomplete({
              source: space_names,
              change: function( event, ui ) {
                scope.$parent.spaceSet(scope.$parent['space']);
                scope.$parent['space']['name'] = $( element ).val();
              }
            });
        }
    };
});
