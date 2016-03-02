<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Battleship</title>
    <meta name="description" content="Battleship">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/public/css/main.css">

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body data-ng-app="battleshipApp">

<div class="container-fluid" data-ng-controller="GameController as game">
    <div class="row">
        <div class="col-lg-5">
            <h2>Your Ships</h2>
            <div class="board col-lg-10 col-lg-offset-1">
                <div class="block col-lg-1"></div>
                <div class="block text-white text-center col-lg-1">A</div>
                <div class="block text-white text-center col-lg-1">B</div>
                <div class="block text-white text-center col-lg-1">C</div>
                <div class="block text-white text-center col-lg-1">D</div>
                <div class="block text-white text-center col-lg-1">E</div>
                <div class="block text-white text-center col-lg-1">F</div>
                <div class="block text-white text-center col-lg-1">G</div>
                <div class="block text-white text-center col-lg-1">H</div>
                <div class="block text-white text-center col-lg-1">I</div>
                <div class="block text-white text-center col-lg-1">J</div>
                <div class="block col-lg-1"></div>
                <div class="line" data-ng-repeat="line in game.player">
                    <div class="block text-white text-center col-lg-1">{[{$index +1}]}</div>
                    <div class="block col-lg-1" data-ng-repeat="block in line" data-ng-class="block.type">{[{block.content}]}</div>
                    <div class="block text-white text-center col-lg-1">{[{$index +1}]}</div>
                </div>
                <div class="block col-lg-1"></div>
                <div class="block text-white text-center col-lg-1">A</div>
                <div class="block text-white text-center col-lg-1">B</div>
                <div class="block text-white text-center col-lg-1">C</div>
                <div class="block text-white text-center col-lg-1">D</div>
                <div class="block text-white text-center col-lg-1">E</div>
                <div class="block text-white text-center col-lg-1">F</div>
                <div class="block text-white text-center col-lg-1">G</div>
                <div class="block text-white text-center col-lg-1">H</div>
                <div class="block text-white text-center col-lg-1">I</div>
                <div class="block text-white text-center col-lg-1">J</div>
                <div class="block col-lg-1"></div>
            </div>
            <div>
                <p>&nbsp;</p>
            </div>
            <div class="board col-lg-10 col-lg-offset-1">
                <div class="col-lg-3">
                    <div class="block col-lg-1 water"></div>
                    <div class="text-left col-lg-2">Water</div>
                </div>
                <div class="col-lg-3">
                    <div class="block col-lg-1 water-hit"></div>
                    <div class="text-left col-lg-2">Water Hit</div>
                </div>
                <div class="col-lg-3">
                    <div class="block col-lg-1 ship"></div>
                    <div class="text-left col-lg-2">Ship</div>
                </div>
                <div class="col-lg-3">
                    <div class="block col-lg-1 ship-hit"></div>
                    <div class="text-left col-lg-2">Ship Hit</div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <p>Turn: {[{game.turn}]}</p>
            <p>Status: {[{game.status}]}</p>
        </div>
        <div class="col-lg-5">
            <h2>Enemy Ships</h2>
            <div class="board col-lg-10 col-lg-offset-1">
                <div class="block col-lg-1"></div>
                <div class="block text-white text-center col-lg-1">A</div>
                <div class="block text-white text-center col-lg-1">B</div>
                <div class="block text-white text-center col-lg-1">C</div>
                <div class="block text-white text-center col-lg-1">D</div>
                <div class="block text-white text-center col-lg-1">E</div>
                <div class="block text-white text-center col-lg-1">F</div>
                <div class="block text-white text-center col-lg-1">G</div>
                <div class="block text-white text-center col-lg-1">H</div>
                <div class="block text-white text-center col-lg-1">I</div>
                <div class="block text-white text-center col-lg-1">J</div>
                <div class="block col-lg-1"></div>
                <div class="line" data-ng-repeat="line in game.opponent">
                    <div class="block text-white text-center col-lg-1">{[{$index +1}]}</div>
                    <div class="block col-lg-1"
                         data-ng-repeat="block in line"
                         data-ng-class="block.type"
                    data-ng-click="game.fire($parent.$index, $index)">{[{block.content}]}</div>
                    <div class="block text-white text-center col-lg-1">{[{$index +1}]}</div>
                </div>
                <div class="block col-lg-1"></div>
                <div class="block text-white text-center col-lg-1">A</div>
                <div class="block text-white text-center col-lg-1">B</div>
                <div class="block text-white text-center col-lg-1">C</div>
                <div class="block text-white text-center col-lg-1">D</div>
                <div class="block text-white text-center col-lg-1">E</div>
                <div class="block text-white text-center col-lg-1">F</div>
                <div class="block text-white text-center col-lg-1">G</div>
                <div class="block text-white text-center col-lg-1">H</div>
                <div class="block text-white text-center col-lg-1">I</div>
                <div class="block text-white text-center col-lg-1">J</div>
                <div class="block col-lg-1"></div>
            </div>
            <div>
                <p>&nbsp;</p>
            </div>
            <div class="board col-lg-10 col-lg-offset-1">
                <div class="col-lg-3">
                    <div class="block col-lg-1 water"></div>
                    <div class="text-left col-lg-2">Water</div>
                </div>
                <div class="col-lg-3">
                    <div class="block col-lg-1 water-hit"></div>
                    <div class="text-left col-lg-2">Water Hit</div>
                </div>
                <div class="col-lg-3">
                    <div class="block col-lg-1 ship"></div>
                    <div class="text-left col-lg-2">Ship</div>
                </div>
                <div class="col-lg-3">
                    <div class="block col-lg-1 ship-hit"></div>
                    <div class="text-left col-lg-2">Ship Hit</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
<script src="/public/js/app.js"></script>
<script src="/public/js/gameService.js"></script>
<script src="/public/js/gameController.js"></script>
<script src="/public/js/opponentController.js"></script>
</body>
</html>