<?php

    require_once('/xampp/htdocs/Ahorcado_superheroes/util/Constant.php');

    class Player {

        private string $name;
        private int $maxFailedIntents = MAX_FAILED_INTENTS;

        public function __construct() {}

        public function getName(): ?string {
            return $this->name;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }

        public function getMaxFailedIntents(): ?int {
            return $this->maxFailedIntents;
        }

        public function setMaxFailedIntents(int $maxFailedIntents): void {
            $this->maxFailedIntents = $maxFailedIntents;
        }

    }


?>