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

        private function chargeSuperHeroes(): bool {
            if (!$json = @file_get_contents(SUPERHEROES_FILE)) {
                return false;
            } else {
                $json_data = json_decode($json, true);
                $this->listSuperHeroes = $json_data;
                print_r($json_data);
            }
            return true;
        }

    }

?>