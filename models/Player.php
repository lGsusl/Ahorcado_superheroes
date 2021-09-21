<?php

    require_once('/xampp/htdocs/Ahorcado_superheroes/utils/Constants.php');

    class Player {

        private string $name;
        private int $lives = LIVES;

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

        public function getLives(): ?int {
            return $this->lives;
        }

        public function setLives(int $lives): void {
            $this->lives = $lives;
        }

        public function decreaseLives(): void {
            if ($this->lives > 0)
                $this->lives--;
        }

    }


?>