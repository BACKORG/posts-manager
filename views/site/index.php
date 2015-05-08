<?php
/* @var $this yii\web\View */
$this->title = 'Post Manager';
?>

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

<div id='site' ng-controller='SocialNetworkListCtrl'>
    <ul class="site-s-n">
        <li ng-repeat="social in socialType">
            <a ng-click="connect($event)" data-id="{{social.id}}" ng-cloak>{{social.name}}</a>
        </li>
    </ul>
</div>