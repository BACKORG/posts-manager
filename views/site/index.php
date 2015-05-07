<?php
/* @var $this yii\web\View */
$this->title = 'Post Manager';
?>

<section id="tpl-intro">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="col-lg-6 col-md-6">
                    <h1>Easy way to delete your posts</h1>
                    <span class="heading-line"></span>
                    <p>Give your a easy way to delete facebook, twitter, instagram, linkedin and any other social network posts.</p>
                    <button type="button" class="btn btn-default intro-btn">Get it now</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <img src="/image/intro-mbp.png" class="img-responsive center-block" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<div id='site' ng-controller='SocialNetwork'>
    <ul class="site-s-n">
        <li ng-repeat="social in socialType">
            <a ng-click="connect($event)" data-id="{{social.id}}">{{social.name}}</a>
        </li>
    </ul>
</div>