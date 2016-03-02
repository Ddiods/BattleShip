(function () {
    "use strict";

    angular.module('battleshipApp')
        .controller('GameController', GameController);

    GameController.$inject = ['$location', '$interval', 'GameService'];

    function GameController($location, $interval, GameService) {
        var game = this;

        game.turn = 0;
        game.status = 'Ready!';

        GameService.setPlayerId($location.absUrl().substr(-1, 1));

        getShips();

        game.fire = function (line, column) {
            game.turn = 0;
            GameService.fire(line, column).then(function(data){
                console.log(data);
               if(data.error){
                   game.status = data.message;
               }
            });
        };

        $interval(function () {
            getShips();
        }, 1000);

        /////////////////////////

        function getShips() {
            GameService.getShips().then(function (data) {
                game.player = data.ships.player;
                game.opponent = data.ships.opponent;
                game.turn = data.turn;

                if(game.turn == GameService.getPlayerId()){
                    game.status = "Ready!";
                }
            })
        }
    }
})();