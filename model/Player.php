<?php

    require_once('/xampp/htdocs/Ahorcado_superheroes/util/Constant.php');

    class Player {

        private string $name;
        private int $maxFailedIntents = MAX_FAILED_INTENTS;

        public function __construct() {
            $arguments = func_get_args();
            $numberOfArguments = func_num_args();

            if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
                call_user_func_array(array($this, $function), $arguments);
            }
        }

        public function __construct1(string $name) {
            $this->name = $name;
        }

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

        public function decreaseMaxFailedIntents(): void {

            if ($this->maxFailedIntents > 0)
                $this->maxFailedIntents--;
        }

    }


?>