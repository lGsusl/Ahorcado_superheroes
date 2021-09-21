<?php

require_once('/xampp/htdocs/Ahorcado_superheroes/utils/Constants.php');
require_once(PLAYER);

    class Game {

        private ArrayObject $listPlayers;
        private array $listSuperHeroes;
        private string $superHero;
        private string $usedChars;

        public function __construct() {}

        public function getListPlayers() : ArrayObject {
            return $this->listPlayers;
        }

        public function setListPlayers(ArrayObject $listPlayers) {
            $this->listPlayers = $listPlayers;
        }

        public function getListSuperHeroes() : array {
            return $this->listSuperHeroes;
        }

        public function setListSuperHeroes(array ...$listSuperHeroes) {
            $this->listSuperHeroes = $listSuperHeroes;
        }

        public function getSuperHero() : ?string {
            return $this->superHero;
        }

        public function setSuperHero(string $superHero) {
            $this->superHero = $superHero;
        } 

        public function getUsedChars() : string {
            return $this->usedChars;
        }

        public function setUsedChars(string $usedChars) {
            $this->usedChars = $usedChars;
        }

        public function chargeSuperHeroes() : bool {

            if (empty($this->listSuperHeroes)) {

                if (!$json = @file_get_contents(SUPERHEROES_FILE)) {
                    return false;

                } else {
                    $json_data = json_decode($json, true);
                    $this->listSuperHeroes = $json_data;
                }

            }
            return true;
        }

        public function selectRandomSuperHero() {
            if (!empty($this->listSuperHeroes))
                $this->superHero = $this->listSuperHeroes[array_rand($this->listSuperHeroes)];
        }

        public function charOrStringIntent(string $charOrString) : bool {
            $stringLength = strlen($charOrString);
            $superHeroLength = strlen(($this->superHero));

            switch($stringLength) {
                case 1:
                    return $this->charIntent($charOrString);
                    break;

                case $superHeroLength:
                    return $this->stringIntent($charOrString);
                    break;

                default:
                    return false;
                    break;
            }

        }

        private function charIntent(string $charHero) : int {
            if (stripos($this->usedChars, $charHero) === false) {
                $this->usedChars .= $charHero;

                if (stripos($this->superHero, $charHero) !== false)
                    return CORRECT_CHAR;
            }

            return ERROR_CHAR_OR_STRING;
        }

        private function stringIntent(string $stringHero) : int {
            if (strcasecmp($stringHero, $this->superHero) == 0)
                return CORRECT_WORD;
            return ERROR_CHAR_OR_STRING;
        }

        public function resetStats() {
            $listPlayers = $this->listPlayers;

            foreach($listPlayers as $player)
                $player->setLives(LIVES);

            unset($this->superHero);
            unset($this->usedChars);
        }

    }

?>