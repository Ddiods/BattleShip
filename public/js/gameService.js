(function () {
    "use strict";

    angular.module('battleshipApp')
        .service('GameService', GameService);

    GameService.$inject = ['$http'];

    function GameService($http) {
        var GameService = this;

        GameService.playerId = '';
        GameService.turn = 0;

        return {
            setPlayerId: setPlayerId,
            getPlayerId: getPlayerId,
            getShips: getShips,
            fire: fire,
            getTurn: getTurn
        };

        ///////////////

        function setPlayerId(playerId) {
            GameService.playerId = playerId;
        }

        function getPlayerId(){
            return GameService.playerId;
        }

        function getShips() {
            return $http.get('/games/api/getShips/', {
                    params: {playerId: GameService.playerId}
                })
                .then(getStartComplete)
                .catch(getStartFailed);

            function getStartComplete(response) {
                GameService.turn = response.turn;
                return response.data;
            }

            function getStartFailed(error) {
                console.log('XHR Failed for getStart.' + error.data);
            }
        }

        function fire(line, column) {
            return $http.get('/games/api/fire/', {
                    params: {
                        playerId: GameService.playerId,
                        line: line,
                        column: column
                    }
                })
                .then(fireComplete)
                .catch(fireFailed);

            function fireComplete(response) {
                if (!response.error) {
                    GameService.turn = response.turn;
                }
                return response.data;
            }

            function fireFailed(error) {
                console.log('XHR Failed for getStart.' + error.data);
            }
        }

        function getTurn() {
            return GameService.turn;
        }
    }
})();