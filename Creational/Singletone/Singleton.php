<?php

class DragonBalls {
    private static ?DragonBalls $instance = null;
    private $ballsCollected;

    /**
     * Only one instance allowed
     */
    private function __construct() {
        $this->ballsCollected = 0;
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DragonBalls();
            echo "A new instance of DragonBalls has been created.\n";
        }
        return self::$instance;
    }

    public function collectBall() {
        if( $this->ballsCollected < 7 ) {
            echo "Congratulations! Keep collecting.\n <br>";
            $this->ballsCollected++;
        } else {
            echo "Make a wish!\n";
            $this->ballsCollected = 0; // Reset after making a wish
        }
    }
}

/**
 * No importa donde se genera la instancia, siempre será la misma
 * Se guarda en una propiedad estática global
 */
echo "Singleton Pattern Example:\n <br>";

$gokuBalls = DragonBalls::getInstance();
$gokuBalls->collectBall();
$gokuBalls->collectBall();
$gokuBalls->collectBall();
$gokuBalls->collectBall();
$gokuBalls->collectBall();

echo "<br>";
$vegetaBalls = DragonBalls::getInstance();
$vegetaBalls->collectBall();
$vegetaBalls->collectBall();
$vegetaBalls->collectBall();

?>