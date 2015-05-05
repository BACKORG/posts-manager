var pmApp = angular.module('pm', []);

pmApp.controller('SocialNetwork', function($scope) {
    $scope.socialType = [
        {name : 'Twitter', id : 10},
        {name : 'Facebook', id : 20}
    ]

    $scope.connect = function(event){
        var $obj = $(event.target),
            typeId = parseInt( $obj.attr('data-id') );

        switch(typeId){
            case 10:
                
            break;

            case 20:

            break;
        }
    }
});