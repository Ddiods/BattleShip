<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller {
    private $shipsBlocks = 31;

    function Start( $playerId ) {
        if ( $playerId == 1 ) {

            Cache::put( 'player1', [ "player" => $this->generateShips(), "opponent" => $this->shipsBase() ], 10 );
            Cache::put( 'player2', [ "player" => $this->generateShips(), "opponent" => $this->shipsBase() ], 10 );
            Cache::put( 'turn', 1, 10 );
        }

        return view( 'index' );
    }

    function generateShips() {
        $base           = $this->shipsBase();
        $shipsRemaining = $this->shipsBlocks;

        while ( $shipsRemaining > 0 ) {
            $row    = rand( 0, 9 );
            $column = rand( 0, 9 );

            $base[ $row ][ $column ]["type"] = "ship";
            $shipsRemaining --;

        }

        return $base;

    }

    function shipsBase() {

        $base = [ ];

        for ( $rows = 0; $rows < 10; $rows ++ ) {
            $temp = [ ];
            for ( $columns = 0; $columns < 10; $columns ++ ) {
                array_push( $temp, [
                    "type" => "water"
                ] );
            }
            array_push( $base, $temp );
        }

        return $base;
    }

    function getShips( Request $request ) {
        $playerId = $request->input( 'playerId' );
        $response = [ "ships" => Cache::get( "player$playerId" ), "turn" => Cache::get( 'turn' ) ];

        return response()->json( $response );
    }

    function fire( Request $request ) {
        $playerId = $request->input( 'playerId' );
        $line     = $request->input( 'line' );
        $column   = $request->input( 'column' );

        if ( Cache::get( 'turn' ) == $playerId ) {


            if ( $playerId == 1 ) {
                $opponentShips = Cache::get( "player2" );
                $myBoard       = Cache::get( "player1" );

            } else {
                $opponentShips = Cache::get( "player1" );
                $myBoard       = Cache::get( "player2" );
            }

            if ( $opponentShips["player"][ $line ][ $column ]["type"] == "ship" ) {
                $myBoard["opponent"][ $line ][ $column ]["type"]     = 'ship-hit';
                $opponentShips["player"][ $line ][ $column ]["type"] = 'ship-hit';
            } else {
                $myBoard["opponent"][ $line ][ $column ]["type"]     = 'water-hit';
                $opponentShips["player"][ $line ][ $column ]["type"] = 'water-hit';
            }
            if ( $playerId == 1 ) {
                Cache::put( "player2", $opponentShips, 10 );
                Cache::put( "player1", $myBoard, 10 );

            } else {
                Cache::put( "player1", $opponentShips, 10 );
                Cache::put( "player2", $myBoard, 10 );
            }
            $turn = $playerId == 1 ? 2 : 1;
            Cache::put( 'turn', $turn, 10 );

            $response = [ "turn" => $turn, "error" => false ];
        } else {
            $response = [ "message" => "It's not your turn!", "error" => true ];
        }

        return response()->json( $response );
    }
}
