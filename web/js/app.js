var pmApp = angular.module('pmApp', [
    'ngRoute',
    'socialNetowkModule'
]);

// document ready
angular.element(document).ready(function () {
    // scroll reveal init
    window.sr = new scrollReveal();

    // init tooltip
    $('[data-toggle="tooltip"]').tooltip()
});

