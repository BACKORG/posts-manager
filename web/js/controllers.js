// social network module
var socialNetowkModule = angular.module('socialNetowkModule', []);
socialNetowkModule.controller('SocialNetworkCtrl', function($scope, $http){
    $scope.socialHeader = "";
    // get social account data
    $http.get('/social').success(function(data) {
        if(!data.error){
            var socials = data.socialData,
                socialArr = [];

            // loop social data to get profile information
            for (var i in socials){
                var insertData = {};
                insertData['type'] = socials[i]['type'];
                insertData['key'] = i;

                switch(socials[i]['type']){
                    case 'twitter':
                        insertData['name'] = socials[i]['name'];
                        insertData['image'] = socials[i]['profile_image_url'];
                        insertData['fontIcon'] = "fa-twitter";
                    break;

                    case 'facebook':
                    case 'facebook_fanpage':
                        insertData['name'] = socials[i]['name'];
                        insertData['image'] = 'https://graph.facebook.com/'+socials[i]['id']+'/picture';
                        insertData['fontIcon'] = "fa-facebook";
                    break;
                }

                socialArr.push(insertData);
            }

            $scope.socialHeader = "You had linked " + socialArr.length + " social account";
            $scope.socialArr = socialArr;
        }
    });


    $scope.loadAccount = function(event){
        var $obj = $(event.target);
        // if the click event is div child, so the obj should change to div
        if(!$obj.attr('data-type')){
            $obj = $obj.closest('div');
        }

        // get attributes
        var key = $obj.attr('data-key'),
            type = $obj.attr('data-type'),
            url = '';

        if(type == 'facebook_fanpage'){
            type = 'facebook';
        }
        
        url = '/social/' + type + '/posts?key=' + key;
        $http.get(url).success(function(res) {
            console.log(res.data);
        });
    }
});