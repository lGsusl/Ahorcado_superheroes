<?php

require_once("Player.php");

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

        private function getListSuperHeroes() : array {
            return $this->listSuperHeroes;
        }

        private function setListSuperHeroes(array ...$listSuperHeroes) {
            $this->listSuperHeroes = $listSuperHeroes;
        }

        private function getSuperHeroe() : string {
            return $this->superHero;
        }

        private function setSuperHeroe(string $superHero) {
            $this->superHero = $superHero;
        } 

        private function getUsedChars() : string {
            return $this->usedChars;
        }

        private function setUsedChars(string $usedChars) {
            $this->usedChars = $usedChars;
        }

    }

?>