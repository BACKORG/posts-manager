// social network module
var socialNetowkModule = angular.module('socialNetowkModule', []);
socialNetowkModule.controller('SocialNetworkListCtrl', function($scope){
    $scope.socialType = [
        {name : 'Twitter', id : 10},
        {name : 'Facebook', id : 20}
    ];


    $scope.connect = function(event){
        var $obj = $(event.target),
            typeId = parseInt( $obj.attr('data-id') );

        console.log(typeId);

        switch(typeId){
            case 10:
                
            break;

            case 20:

            break;
        }
    }
});