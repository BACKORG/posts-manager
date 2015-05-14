<?php
/* @var $this yii\web\View */
$this->title = 'Post Manager';
?>

<!-- banner -->
<section id="tpl-intro">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="col-lg-6 col-md-6 col-xs-12" data-sr="scale up 20%, over 1.5s">
                    <h1>Easy way to delete your posts</h1>
                    <span class="heading-line"></span>
                    <p>Give your a easy way to delete facebook, twitter, instagram, linkedin and any other social network posts.</p>
                    <button type="button" class="btn btn-default intro-btn">Get it now</button>
                </div>

                <div class="col-lg-6 col-md-6 col-xs-12" data-sr="enter right, move 100px, over 1.5s">
                    <img src="/image/intro-mbp.png" class="img-responsive center-block" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- intro -->
<section id="tpl-services">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 t-s-info-wrap" data-sr="wait 1s, enter left, ease-in-out 100px, over 0.5s">
                <div class="t-s-info">
                    <i class="fa fa-cogs"></i>
                    <h4>Easy delete</h4>
                    <p>We can give you a super easy way to delete your social network posts.</p>
                </div>             
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 t-s-info-wrap" data-sr="wait 1.5s, enter left, ease-in-out 100px, over 0.5s">
                <div class="t-s-info">
                    <i class="fa fa-html5"></i>
                    <h4>Html5 support</h4>
                    <p>Our product support all new version html5 and css3 browser.</p>
                </div>  
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 t-s-info-wrap" data-sr="wait 2s, enter left, ease-in-out 100px, over 0.5s">
                <div class="t-s-info">
                    <i class="fa fa-users"></i>
                    <h4>Online help</h4>
                    <p>You can ask help online, we will reply you as soon as possible.</p>
                </div>  
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 t-s-info-wrap" data-sr="wait 2.5s, enter left, ease-in-out 100px, over 0.5s">
                <div class="t-s-info">
                    <i class="fa fa-desktop"></i>
                    <h4>Fully responsive</h4>
                    <p>Our product support  Desktop, Pad and Mobile device.</p>
                </div>  
            </div>
        </div>
    </div>
</section>

<!-- display linked accounts -->
<section id='tpl-account' class='container' ng-controller='SocialNetworkCtrl'>
    <h2 class="text-center t-a-sh">{{socialHeader}}</h2>

    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 t-s-at-wrap" ng-repeat="social in socialArr" ng-cloak>
        <div class="t-s-at" data-type="{{social.type}}" data-key="{{social.key}}" ng-click="loadAccount($event)">
            <img ng-src="{{social.image}}">
            <span>{{social.name}}</span>
            <span class="fa-banner">
                <i class="fa {{social.fontIcon}}"></i>
            </span>
        </div>
        <i class="fa fa-check"></i>
    </div>

    <div class="clearfix"></div>

    <!-- load social posts data -->
    <div class="s-n-p-tpl clearfix" ng-include src="getTpl()"></div>
</section>

<!-- connect your social network account -->
<section id="tpl-social-connect">
   <div class="container">
        <div class="row text-center">
            <h1>Manage your social network account!</h1>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">            
                    <a href="/social/twitter/connect">  
                        <i class="fa fa-twitter-square"  data-toggle="tooltip" data-placement="top" title="Connect Twitter"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">            
                    <a href="/social/facebook/connect">
                        <i class="fa fa-facebook-square" data-toggle="tooltip" data-placement="top" title="Connect Facebook"></i>
                    </a>      
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>  
                        <i class="fa fa-youtube"  data-toggle="tooltip" data-placement="top" title="Working on Youtube"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>  
                        <i class="fa fa-instagram"  data-toggle="tooltip" data-placement="top" title="Working on Instagram"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>
                        <i class="fa fa-reddit-square"  data-toggle="tooltip" data-placement="top" title="Working on Reddit"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">      
                    <a>        
                        <i class="fa fa-linkedin" data-toggle="tooltip" data-placement="top" title="Working on Linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">                  
                    <a>
                        <i class="fa fa-tumblr-square" data-toggle="tooltip" data-placement="top" title="Working on Tumblr"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>
                        <i class="fa fa-flickr" data-toggle="tooltip" data-placement="top" title="Working on Flickr"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>
                        <i class="fa fa-weibo" data-toggle="tooltip" data-placement="top" title="Working on Weibo"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>
                        <i class="fa fa-wechat" data-toggle="tooltip" data-placement="top" title="Working on Wechat"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>
                       <i class="fa fa-qq" data-toggle="tooltip" data-placement="top" title="Working on QQ"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="t-s-c-wrap">              
                    <a>
                       <i class="fa fa-renren" data-toggle="tooltip" data-placement="top" title="Working on Renren"></i>
                    </a>
                </div>
            </div>
        </div>
   </div>
</section>

