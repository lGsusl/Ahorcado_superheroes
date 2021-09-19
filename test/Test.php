<?php

    require_once('/xampp/htdocs/Ahorcado_superheroes/model/Player.php');
    require_once('/xampp/htdocs/Ahorcado_superheroes/model/Game.php');

    /** TEST Player */
    echo "<b>TEST Player<br>--------------------</b><br><br>";
    $player1 = new Player();

    /** Prueba 1 - Jugador creado sin modificar atributos */
    echo "<b>Prueba 1 - Sin modificar atributos</b>"
    ."<br>------------------------------------------<br>";
    var_dump($player1); //Utilizamos var_dump, si utilitzamos echo, al no tener inicialización los atributos, dará error (si inicializamos a "null", simplemente no mostraría nada)
    echo "<br>----------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";

    /** Prueba 2 - Modificando atributos */
    echo "<b>Prueba 2 - Modificando atributos<br>------------------------------------------</b><br>";
    $player1->setName("Usuario 1");
    $player1->setMaxFailedIntents("5");

    echo "Nombre del Player1 = " . $player1->getName();
    echo "<br>Número de Intentos fallidos máximos del Player 1 = " . $player1->getMaxFailedIntents()
    ."<br>------------------------------------------------------------------<br>";
    var_dump($player1);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";

    /** Prueba 3 - Crear nuevo Jugador pasando por argumento el nombre en el constructor */
    $player2 = new Player("Usuario 2");

    echo "<b>Prueba 3 - Crear nuevo Jugador pasando por argumento el nombre en el constructor</b>".
    "<br>------------------------------------------------------------------------------------------------------<br>";
    echo "Nombre del Player2 = " . $player2->getName();
    echo "<br>Número de Intentos fallidos máximos del Player 2 = " . $player2->getMaxFailedIntents() . "<br>-------------------------------------------------------------------<br>";
    var_dump($player2);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";

    /** Prueba 4 - Reducimos valores de maxFailedIntents de los Jugadores */
    echo "<b>Prueba 4 - Reducimos valores de maxFailedIntents de los Jugadores</b>".
    "<br>-----------------------------------------------------------------------------------------<br>";
    $player1->decreaseMaxFailedIntents();
    $player2->decreaseMaxFailedIntents();

    echo "Número de Intentos fallidos máximos del Player 1 = " . $player1->getMaxFailedIntents()
    ."<br>------------------------------------------------------------------<br>";
    var_dump($player1);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";

    echo "Número de Intentos fallidos máximos del Player 2 = " . $player2->getMaxFailedIntents() . "<br>-------------------------------------------------------------------<br>";
    var_dump($player2);
    echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";

    /**  Prueba 5 - Reducimos valores de maxFailedIntents del Jugador 1 hasta 0 y posteriormente, intentando reducir por debajo de 0 */
    

    /** TEST Game (Object) */
    echo "<br><br><br>TEST Game<br>--------------------<br>";
    $game = new Game();

    /** Prueba 1 - Sin modificar atributos */
    var_dump($game);

    /** Prueba 2 - Modificando atributos */
    $player3 = new Player();    //Creamos un usuario más añadir a la lista de Jugadores
    $player3->setName("Usuario 2");

    $listPlayers = new ArrayObject();   //Creamos una lista de Objetos para guardar los Jugadores
    $listPlayers->append($player1);
    $listPlayers->append($player2);

    $game->setListPlayers($listPlayers);    //Guardamos en el objeto Game
    $gameListPlayers = $game->getListPlayers();
    
    echo "<br><br>";
    /* Comprobamos que al recuperar la lista esten los Jugadores anteriormente añadidos */
    foreach ($gameListPlayers as $player)
        echo "<br>". var_dump($player) ."<br>";

    /* Extraemos los superheroes del fichero superheroes.json */
    echo "Testing ACCESS a FILE <br>-------------------------------<br>";
    if (!$json = @file_get_contents(SUPERHEROES_FILE)) {
        $error = error_get_last();
        echo "<br>Error:" . $error['message'];
    } else {
        $json_data = json_decode($json, true);
        print_r($json_data);
    }


    
?>