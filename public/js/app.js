(function () {
    "use strict";

    angular
        .module('battleshipApp', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

})();