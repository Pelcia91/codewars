/*
Introduction
 	Welcome Adventurer. Your aim is to navigate the maze and reach the finish point without touching any walls. Doing so will kill you instantly!

Task
     You will be given a 2D array of the maze and an array of directions. Your task is to follow the directions given. If you reach the end point before all your moves have gone, you should return Finish. If you hit any walls or go outside the maze border, you should return Dead. If you find yourself still in the maze after using all the moves, you should return Lost.

The Maze array will look like

maze = [[1,1,1,1,1,1,1],
        [1,0,0,0,0,0,3],
        [1,0,1,0,1,0,1],
        [0,0,1,0,0,0,1],
        [1,0,1,0,1,0,1],
        [1,0,0,0,0,0,1],
        [1,2,1,0,1,0,1]];

..with the following key

0 = Safe place to walk
1 = Wall
2 = Start Point
3 = Finish Point

direction = ["N","N","N","N","N","E","E","E","E","E"] == "Finish"

Rules
 	1. The Maze array will always be square i.e. N x N but its size and content will alter from test to test.
    2. The start and finish positions will change for the final tests.
    3. The directions array will always be in upper case and will be in the format of N = North, E = East, W = West and S = South.

*/

class Maze {

    protected $maze;

    const SAFE = 0;
    const WALL = 1;
    const START = 2;
    const FINISH = 3;

    const R_DEAD = 'Dead';
    const R_FINISH = 'Finish';
    const R_LOST = 'Lost';

    function __construct($maze) {
    $this->maze = $maze;
    }

    public function findStart(){

        foreach($this->maze as $row => $rowValue) {
            foreach($rowValue as $column => $columnValue) {
                if ( $columnValue == self::START ) {
                    return compact('row', 'column');
                }
            }
        }
        return null; // if doesn't find
    }

    private function walk($row, $column, $direct) {

        switch ($direct) {
            case "N":
            $row--;
            break;
            case "S":
            $row++;
            break;
            case "E":
            $column++;
            break;
            case "W":
            $column--;
            break;
        }

        return compact('row', 'column');
    }

    private function check($position) {

        $result = self::R_LOST;

        if( isset( $this->maze[$position['row']][$position['column']] ) && ($this->maze[$position['row']][$position['column']] !== null) ) {

            switch ( $this->maze[$position['row']][$position['column']] ) {
                case self::SAFE:
                case self::START:
                    $result = self::SAFE;
                    break;
                case self::WALL:
                    $result = self::R_DEAD;
                    break;
                case self::FINISH:
                    $result = self::R_FINISH;
                    break;
            }
        }
        else {
            $result = self::R_DEAD;
        }

        return $result;
    }

    public function search($directions) {

        $start = $this->findStart();

        if( !is_array($start) && isset($start['row']) && isset($start['column']) ) {
            return self::R_LOST;
        }

        foreach ($directions as $direction) {

            $start = $this->walk($start['row'], $start['column'], $direction);
            $result = $this->check($start);

            if($result !== self::SAFE) {
                return $result;
            }
        }

        return self::R_LOST; // still in the maze after using all moves
    }
}

function maze_runner($maze, $directions): string {

    $maze = new Maze($maze);
    $result = $maze->search($directions);

    return $result;
}