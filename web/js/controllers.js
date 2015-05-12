// social network module
var socialNetowkModule = angular.module('socialNetowkModule', []);
socialNetowkModule.controller('SocialNetworkCtrl', function($scope, $http){
    // get social account data
    $http.get('/social').success(function(data) {
        if(!data.error){
            var socials = data.socialData,
                insertData = {},
                socialArr = [];

            // loop social data to get profile information
            for (var i in socials){
                switch(socials[i]['type']){
                    case 'twitter':
                        insertData = {
                            name : socials[i]['name'],
                            image : socials[i]['profile_image_url']
                        }
                    break;

                    case 'facebook':
                        insertData = {
                            name : socials[i]['name'],
                            image : 'https://graph.facebook.com/'+socials[i]['id']+'/picture' 
                        }
                    break;
                }

                socialArr.push(insertData);
            }

            $scope.socialArr = socialArr;
        }
    });


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