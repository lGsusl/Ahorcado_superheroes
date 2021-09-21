<?php

    require_once('/xampp/htdocs/Ahorcado_superheroes/utils/Constants.php');
    require_once(PLAYER);
    require_once(GAME);

    /** TEST Player */
    echo "<b>TEST Player<br>--------------------</b><br><br>";


    /** Prueba 1 - Jugador creado sin modificar atributos */
    $player1 = new Player();

    echo "<b>Prueba 1 - Sin modificar atributos</b>"
    ."<br>------------------------------------------<br>";
    var_dump($player1); //Utilizamos var_dump, si utilitzamos echo, al no tener inicializados los atributos, dará error (si inicializamos a "null", simplemente no mostraría nada)
    echo "<br>----------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";


    /** Prueba 2 - Modificando atributos */
    echo "<b>Prueba 2 - Modificando atributos<br>------------------------------------------</b><br>";
    $player1->setName("Usuario 1");
    $player1->getLives("5");

    echo "Nombre del Player1 = " . $player1->getName();
    echo "<br>Número de Vidas Restantes del Player 1 = " . $player1->getLives()
    ."<br>------------------------------------------------------------------<br>";
    var_dump($player1);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";


    /** Prueba 3 - Crear nuevo Jugador pasando por argumento el nombre en el constructor */
    $player2 = new Player("Usuario 2");

    echo "<b>Prueba 3 - Crear nuevo Jugador pasando por argumento el nombre en el constructor</b>".
    "<br>------------------------------------------------------------------------------------------------------<br>";
    echo "Nombre del Player2 = " . $player2->getName();
    echo "<br>Número de Vidas Restantes del Player 2 = " . $player2->getLives() . "<br>-------------------------------------------------------------------<br>";
    var_dump($player2);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";


    /** Prueba 4 - Reducimos valores de maxFailedIntents de los Jugadores */
    echo "<b>Prueba 4 - Reducimos valores de Vidas Restantes de los Jugadores</b>".
    "<br>-----------------------------------------------------------------------------------------<br>";
    $player1->decreaseLives();
    $player2->decreaseLives();

    echo "Número de Vidas Restantes del Player 1 = " . $player1->getLives()
    ."<br>------------------------------------------------------------------<br>";
    var_dump($player1);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";

    echo "Número de Vidas Restantes del Player 2 = " . $player2->getLives() . "<br>-------------------------------------------------------------------<br>";
    var_dump($player2);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";


    /**  Prueba 5 - Reducimos valores de maxFailedIntents del Jugador 1 hasta 0 y posteriormente, intentando reducir por debajo de 0 */
    echo "<b>Prueba 5 - Reducimos valores de Vidas Restantes del Jugador 1 hasta 0 y posteriormente, intentando reducir por debajo de 0</b>".
    "<br>-------------------------------------------------------------------------------------------------------------------------------<br>";
    
    $remaining_lives = $player1->getLives();
    for ($i = $remaining_lives; $i > 0; $i--) {
        $player1->decreaseLives();
    }

    echo "Número de Vidas Restantes del Player 1 = " . $player1->getLives()
    ."<br>------------------------------------------------------------------<br>";
    var_dump($player1);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";

    $player1->decreaseLives();
    echo "Número de Vidas Restantes del Player 1 = " . $player1->getLives()
    ."<br>------------------------------------------------------------------<br>";
    var_dump($player1);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";
    


    /** TEST Game (Object) */
    echo "<br><br><br><b>TEST Game</b><br>--------------------<br><br>";


    /** Prueba 1 - Sin modificar atributos */
    $game = new Game();

    echo "<b>Prueba 1 - Sin modificar atributos</b>"
    ."<br>----------------------------------------------<br>";
    var_dump($game);
    echo "<br>----------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";


    /** Prueba 2 - Modificando atributos */
    echo "<b>Prueba 2 - Modificando atributos<br>------------------------------------------</b><br>";
    $listPlayers = new ArrayObject();   //Creamos una lista de Objetos para guardar los Jugadores
    $listPlayers->append($player1);
    $listPlayers->append($player2);

    $game->setListPlayers($listPlayers);    //Guardamos en el objeto Game
    $gameListPlayers = $game->getListPlayers();
    
    /* Comprobamos que al recuperar la lista esten los Jugadores anteriormente añadidos */
    foreach ($gameListPlayers as $player)
        echo "". var_dump($player) ."<br>";
    
    /** Introducimos letras y repetimos */
    echo "----------------------------------------------------------------------------------------------------------------------------------------------------<br>";
    var_dump($game);
    echo "<br>----------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";


    /* Extraemos los superheroes del fichero superheroes.json */
    echo "<b>Testing ACCESS a FILE </b><br>-------------------------------<br>";
    if (!$json = @file_get_contents(SUPERHEROES_FILE)) {
        $error = error_get_last();
        echo "<br>Error:" . $error['message'];
    } else {
        $json_data = json_decode($json, true);
        print_r($json_data);
    }


    /** Prueba 3 - Cargando Superhéroes al Game */
    echo "<br><br><b>Prueba 3 - Cargando Super Heroes al Game<br>------------------------------------------</b><br>";
    if ($game->chargeSuperHeroes()) {
        echo "Hemos podido acceder al fichero .json de los Super Heroes<br>";

        $superHeros = $game->getListSuperHeroes();

        foreach ($superHeros as $superHero) {
            echo "<br>".$superHero;
        }
    }


    /** Prueba 4 - Seleccionar un Superhéeroe Random */
    echo "<br><br><b>Prueba 4 - Seleccionar un Super Heroe Random<br>------------------------------------------</b>";
    $game->selectRandomSuperHero();
    $superHero = $game->getSuperHero();
    echo "<br>".$superHero;

    $game->selectRandomSuperHero();
    $superHero = $game->getSuperHero();
    echo "<br>".$superHero;


    /** Prueba 5 - Cargar "_" en función del Superhéroe */
    echo "<br><br><b>Prueba 5 - Cargar '_' en función del Superhéroe<br>------------------------------------------</b><br>";
    $underscores = "";
    $superHeroLength = strlen($superHero);

    for ($i = 0; $i < $superHeroLength; $i++) {
        
        switch ($superHero[$i]) {
            case "-":
                $underscores .= "-";
                break;

            case " ":
                $underscores .= " ";
                break;

            default:
                $underscores .= "_";
                break;

        }
    }

    $underscoresLength = strlen($underscores);

    for ($i = 0; $i < $underscoresLength; $i++) {

        if ($underscores[$i] == " ")
            echo "&nbsp;";      //Espacio reconocido por HTML
        echo $underscores[$i] . " ";
    }
    echo "<br>"; 
    var_dump($underscores);
    

    /** Prueba 6 - Introducimos carácteres random con el Jugador 1 (con Vidas) */
    echo "<br><br><b>Prueba 6 - Introducimos carácteres random con el Jugador 1 (con Vidas) <br>------------------------------------------</b><br>";
    $possibleChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $possibleCharsLength = strlen($possibleChars);

    $game->setUsedChars("");
    $player1->setLives(LIVES);
    $superHero = $game->getSuperHero();
    $i = 0;
    $end = false;

    echo "Vidas del Jugador 1 (al Principio): " .$player1->getLives();

    while ($i < $possibleCharsLength && !$end) {
        $randomIndex = mt_rand(0, $possibleCharsLength - 1);
        $char = $possibleChars[$randomIndex];
        $result = $game->charOrStringIntent($char);

        switch($result) {

            case CORRECT_CHAR:
                $posChar = stripos($superHero, $char);

                while ($posChar !== false) {
                    $underscores[$posChar] = $char;
                    $posChar = stripos($superHero, $char, ++$posChar);
                }

                /** Comparar con cadena de _ _ _ _ , si está resuelta, tenemos ganador */
                if (strcasecmp($underscores, $superHero) == 0) {
                    echo "<br>Ganador: ". $player1->getName();
                    $end = true;
                }
                break;

            case ERROR_CHAR_OR_STRING:
                $player1->decreaseLives();

                if ($player1->getLives() == 0) {
                    echo "<br>Perdedor: ". $player1->getName();
                    $end = true;
                }
                break;

        }

        $i++;

    }

    echo "<br>------------------------------<br>Vidas del Jugador 1 (al Final): " .$player1->getLives();
    echo "<br>Letras utilizadas: ".$game->getUsedChars();
    echo "<br>".$underscores;
    

    /** Prueba 7 - Introducimos carácteres random con el Jugador 1 (sin importar las Vidas) / Resetamos Vidas y Guiones Bajos */
    echo "<br><br><b>Prueba 7 - Introducimos carácteres random con el Jugador 1 (sin importar las Vidas) / Resetamos Vidas y Guiones Bajos <br>------------------------------------------</b><br>";

    $game->setUsedChars("");
    $player1->setLives(LIVES);
    $underscores = "";
    $end = false;

    for ($i = 0; $i < $superHeroLength; $i++) {
        
        switch ($superHero[$i]) {
            case "-":
                $underscores .= "-";
                break;

            case " ":
                $underscores .= " ";
                break;

            default:
                $underscores .= "_";
                break;

        }
    }

    $i = 0;
    echo "Vidas del Jugador 1 (al Principio): " .$player1->getLives();

    while (!$end) {
        $char = $possibleChars[$i];
        $result = $game->charOrStringIntent($char);

        switch($result) {

            case CORRECT_CHAR:
                $superHero = $game->getSuperHero();
                $posChar = stripos($superHero, $char);

                while ($posChar !== false) {
                    $underscores[$posChar] = $char;
                    $posChar = stripos($superHero, $char, ++$posChar);
                }

                /** Comparar con cadena de _ _ _ _ , si está resuelta, tenemos ganador */
                if (strcasecmp($underscores, $superHero) == 0) {
                    echo "<br>Ganador: ". $player1->getName();
                    $end = true;
                }
                break;

            case ERROR_CHAR_OR_STRING:
                break;

        }

        $i++;

    }

    echo "<br>------------------------------<br>Vidas del Jugador 1 (al Final): " .$player1->getLives();
    echo "<br>Letras utilizadas: ".$game->getUsedChars();
    echo "<br>".$underscores;

    /** Prueba 8 - Reset de los atributos del Game */
    echo "<br><br><b>Prueba 8 - Reset de los atributos del Game (modificamos Vida Jugador 1)<br>------------------------------------------</b><br>";
    echo "<b>Fin del Juego anterior<br>-----------------------------------</b><br>";
    $player1->setLives(5);
    $gameListPlayers = $game->getListPlayers();

    foreach($gameListPlayers as $player) {
        echo "Nombre Jugador: " .$player->getName();
        echo "<br>Nº Vidas: " .$player->getLives() ."<br>------------------------------------------------------<br>";
    }

    echo "Superheroe: " .$game->getSuperHero() ."<br>------------------------------------------------------<br>";

    $game->resetStats();
    echo "<br><b>Vidas, Superheroe y Letras Usadas reseteadas<br>----------------------------------------------------------</b><br>";
    foreach($gameListPlayers as $player) {
        echo "Nombre Jugador: " .$player->getName();
        echo "<br>Nº Vidas: " .$player->getLives() . "<br>------------------------------------------------------<br>";
    }

    try {
        $tSuperHero = $game->getSuperHero();
    } catch (Error $e) {
        echo "Error, no ha sido seleccionado aún ningún Superhéroe: --> ". $e->getMessage();
    }
    
?>