<?php
/* @var $this yii\web\View */
$this->title = 'Post Manager';
?>
<div id='site' ng-controller='SocialNetwork'>
    <ul class="site-s-n">
        <li ng-repeat="social in socialType">
            <a ng-click="connect($event)" data-id="{{social.id}}">{{social.name}}</a>
        </li>
    </ul>
</div>