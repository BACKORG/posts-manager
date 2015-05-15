<?php
if(YII_ENV_DEV){
    return [
        'adminEmail' => 'admin@example.com',
        'TWITTER_CONSUMER_KEY' => 'gwbn7q3oHWgrVLpmRBin8ld6P',
        'TWITTER_CONSUMER_SECRET' => 'n0BptDEWuThYVglyKEsjmGhzo4EAD9lE2bgYPRrQbxNN09Djgu',
        'TWITTER_CALLBACK_URL' => 'http://local.pm.com/social/twitter/auth',
        'FACEBOOK_APP_ID' => '1572559796331951',
        'FACEBOOK_APP_SECRET' => '7c703291433b52cc23b5e1707d3a87a3',
        'FACEBOOK_REDIRECT_URL' => 'http://local.pm.com/social/facebook/auth',
        'INSTAGRAM_CLIENT_ID' => '3bd4a779086f467da618c95fe4e54cb7',
        'INSTAGRAM_CLIENT_SECRET' => 'b3589f1b833445ba927058e3de9f8dd8',
        'INSTAGRAM_REDIRECT_URL' => 'http://local.pm.com/social/instagram/auth',  
    ];
}else{
    return [
        'adminEmail' => 'admin@example.com',
        'TWITTER_CONSUMER_KEY' => 'gwbn7q3oHWgrVLpmRBin8ld6P',
        'TWITTER_CONSUMER_SECRET' => 'n0BptDEWuThYVglyKEsjmGhzo4EAD9lE2bgYPRrQbxNN09Djgu',
        'TWITTER_CALLBACK_URL' => 'http://local.pm.com/social/twitter/auth',
        'FACEBOOK_APP_ID' => '1572559796331951',
        'FACEBOOK_APP_SECRET' => '7c703291433b52cc23b5e1707d3a87a3',
        'FACEBOOK_REDIRECT_URL' => 'http://local.pm.com/social/facebook/auth',
        'INSTAGRAM_CLIENT_ID' => '1bbdad644b5443829415d58f58b1e63c',
        'INSTAGRAM_CLIENT_SECRET' => 'c1893512b55649b8a3193f1d05aa678a',
        'INSTAGRAM_REDIRECT_URL' => 'http://pm.zhexiao.space/social/instagram/auth',  
    ];
}

