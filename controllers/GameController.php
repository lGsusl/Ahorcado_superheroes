<?php

require_once('/xampp/htdocs/Ahorcado_superheroes/utils/Constants.php');
require_once(PLAYER);
require_once(GAME);

class GameController {

    private Game $game;
    private string $underscores;

    public function __construct() {}

    public function createGame() {
        if (is_null($this->game)) {
            $this->game = new Game();
        }
        $this->underscores = "";
        $this->startGame();
    }

    public function startGame() {
        
        if (!is_null($this->game)) {

            $this->game->resetStats();
            
            if (is_null($this->game->getListSuperHeroes())) {
                
                if (!$this->game->chargeSuperHeroes()) {
                    echo "<br>Hay un error al cargar los Superhéroes";
                }
                 else {
                    $this->game->selectRandomSuperHero();
                }
            }
        
        }
    }

    public function checkCharOrStringIntent(string $charOrString, Player $player) {
        
        $result = $this->game->charOrStringIntent($charOrString);

        switch($result) {

            case CORRECT_CHAR:
                $superHero = $this->game->getSuperHero();
                $posChar = stripos($superHero, $charOrString);

                while ($posChar != false) {
                    $this->modifyUnderscores($charOrString, $posChar);
                    $posChar = stripos($superHero, $charOrString, ++$posChar);
                }

                /** Comparar con cadena de _ _ _ _ , si está resuelta, tenemos ganador */
                if (strcasecmp("", $this->game->getSuperHero()))
                    $this->endGame($player);

                break;

            case CORRECT_WORD:
                $this->endGame($player);
                break;

            case ERROR_CHAR_OR_STRING:
                $player->decreaseLives();

                if ($player->getLives() == 0)
                    $this->checkLivesOfPlayers();
                break;

        }

    }

    public function checkLivesOfPlayers() {
        $listPlayers = $this->game->getListPlayers();
        $playersOut = 0;

        foreach ($listPlayers as $player) {
            if ($player->getLives() == 0) {
                $playersOut++;
            }
        }

        /*if ($playersOut == $listPlayers->count())
            $this->endGame();*/
    }

    public function endGame(Player $possibleWinner) {
        
        $listPlayers = $this->game->getListPlayers();
        $nameOfThePossibleWinner = $possibleWinner->getName();

        foreach($listPlayers as $player) {
            if (strcasecmp($player, $nameOfThePossibleWinner) != 0) {
                echo "Perdedor: " . $player->getName();
            } 
        }
        
        if ($possibleWinner->getLives() > 0)
            echo "Ganador: " . $nameOfThePossibleWinner;
        else 
            echo "Perdedor: " . $nameOfThePossibleWinner;

    }
        

    /** Función para modificar los guiones bajos de la vista */
    public function modifyUnderscores(string $char, int $posUnderscore) {
        $this->underscores[$posUnderscore] = $char;
    }


} 


?>