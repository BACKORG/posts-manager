// social network module
var socialNetowkModule = angular.module('socialNetowkModule', []);
socialNetowkModule.controller('SocialNetworkCtrl', function($scope, $http, $timeout){
    $scope.choosePostHeader = "Click content mark to delete";

    /**
     * get social account data
     */
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

            $scope.socialHeader = "You have " + socialArr.length + " social network accounts connected";
            $scope.socialArr = socialArr;
        }
    });

    /**
     * load posts
     * @param  {[type]} event [description]
     * @return {[type]}       [description]
     */
    $scope.loadAccount = function(event){
        var $obj = $(event.target);
        // if the click event is div child, so the obj should change to div
        if(!$obj.attr('data-type')){
            $obj = $obj.closest('div');
        }

        $('.t-s-at-wrap').removeClass('active');
        $obj.closest('.t-s-at-wrap').addClass('active');

        // get attributes
        var key = $obj.attr('data-key'),
            type = $obj.attr('data-type'),
            url = '';

        // if type is facebook fanpage, change to facebook
        if(type == 'facebook_fanpage'){
            type = 'facebook';
        }
        
        $scope.socialTpl = '/template/' + type + '.html';
        // get data
        url = '/social/' + type + '/posts?key=' + key;
        $http.get(url).success(function(res) {
            $scope.socialPosts = res.data;
            $scope.socialType = type;
            $scope.socialKey = key;
        });
    }

    /**
     * return posts display template
     * @return {[type]} [description]
     */
    $scope.getTpl = function(){
        return  this.socialTpl;
    }

    /**
     * mark this post is need delete
     * @return {[type]} [description]
     */
    $scope.markDelete = function(event){
        var $obj = $(event.target);
        // if the click event is div child, make the $obj to be parent DOM
        if(!$obj.attr('data-id')){
            $obj = $obj.closest('.s-n-p');
        }

        if($obj.hasClass('delete')){
            $obj.removeClass('delete');
        }else{
            $obj.addClass('delete');
        }
    }

    /**
     * delete posted status
     * @param  {[type]} event [description]
     * @return {[type]}       [description]
     */
    $scope.deletePost = function(event){
        var $obj = $(event.target),
            type = this.socialType,
            key = this.socialKey,
            url = '',
            delId = [],
            data = {};

        // get the post id which need to be deleted
        $obj.closest('.s-n-p-tpl').find('.s-n-p.delete').each(function(){
            delId.push($(this).attr('data-id'));
        })

        // generate post url
        url = '/social/' + type + '/del';
        data.id = delId;
        data.key = key;

        // post data
        $http({
            method: 'POST',
            url: url,
            data: $.param(data),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(res){
            $obj.closest('.s-n-p-tpl').find('.s-n-p.delete').fadeOut();

            $scope.setError(true, 'asdasd');
        })
    }

    /**
     * get facebook text
     * @param  {[type]} post [description]
     * @return {[type]}      [description]
     */
    $scope.getFacebookText = function(post){
        if(post.hasOwnProperty('message')){
            return post.message;
        }else if(post.hasOwnProperty('description')){
            return post.description;
        }else if(post.hasOwnProperty('story')){
            return post.story;
        }
    }

    /**
     * get facebook link
     * @param  {[type]} post [description]
     * @return {[type]}      [description]
     */
    $scope.getFacebookLink = function(post){
        var postId = post.id;
        return 'https://www.facebook.com/' + postId.replace('_', '/posts/');
    }

    /**
     * set error
     */
    $scope.setError = function(stat, msg){
        $scope.errorStatus = stat;
        $scope.errorMsg = msg;

        // hide error 
        $timeout(function(){
            $scope.errorStatus = false;
        }, 3000);
    }
});