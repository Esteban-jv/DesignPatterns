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

echo "Singleton Pattern Example:\n <br>";

$dragonBalls1 = DragonBalls::getInstance();
$dragonBalls1->collectBall();
$dragonBalls1->collectBall();
$dragonBalls1->collectBall();
$dragonBalls1->collectBall();
$dragonBalls1->collectBall();
$dragonBalls1->collectBall();
$dragonBalls1->collectBall();
$dragonBalls1->collectBall();

?>