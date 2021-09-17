<?php

    require_once('/xampp/htdocs/Ahorcado_superheroes/model/Player.php');
    require_once('/xampp/htdocs/Ahorcado_superheroes/model/Game.php');

    /** TEST Player */
    echo "TEST Player<br>--------------------<br>";
    $player1 = new Player();

    /** Prueba 1 - Sin modificar atributos */
    var_dump($player1); //Utilizamos var_dump, si utilitzamos echo, al no tener inicialización los atributos, dará error (si inicializamos a "null", simplemente no mostraría nada)

    /** Prueba 2 - Modificando atributos */
    $player1->setName("Usuario 1");
    $player1->setMaxFailedIntents("5");

    /* Utilizamos "echo" al tener ya los atributos con valores, también se realiza prueba con var_dump */
    echo "<br>---------------------------------------------------------------<br>Nombre del Player1 = " . $player1->getName();
    echo "<br>Número de Intentos fallidos máximos = " . $player1->getMaxFailedIntents() . "<br>---------------------------------------------------------------<br>";
    var_dump($player1);

    /** TEST Game (Object) */
    echo "<br><br><br>TEST Game<br>--------------------<br>";
    $game = new Game();

    /** Prueba 1 - Sin modificar atributos */
    var_dump($game);

    /** Prueba 2 - Modificando atributos */
    $player2 = new Player();    //Creamos un usuario más añadir a la lista de Jugadores
    $player2->setName("Usuario 2");

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
    if (!$json = @file_get_contents(SUPERHEROES_FILE)) {
        $error = error_get_last();
        echo "<br>Error:" . $error['message'];
    } else {
        $json_data = json_decode($json, true);
        print_r($json_data);
    }
    
?>