class Vector {
  public $i;
  public $j;
  public $k;

  public function __construct($i, $j, $k) {
    $this->i = $i;
    $this->j = $j;
    $this->k = $k;
  }

  public function getMagnitude() {
    return sqrt(array_sum([$this->i ** 2, $this->j ** 2, $this->k ** 2]));
  }

  static public function getI() {
    return new self(1.0, 0.0, 0.0);
  }

  static public function getJ() {
    return new self(0.0, 1.0, 0.0);
  }

  static public function getK() {
    return new self(0.0, 0.0, 1.0);
  }

  public function add(Vector $vector) {
    return new self($this->i + $vector->i, $this->j + $vector->j, $this->k + $vector->k);
  }

  public function multiplyByScalar($number) {
    return new self($this->i * $number, $this->j * $number, $this->k * $number);
  }

  public function dot(Vector $vector) {
    return array_sum(array_map(function($a, $b) {
              return $a * $b;
           }, [$this->i, $this->j, $this->k], [$vector->i, $vector->j, $vector->k] ));
  }

  public function cross(Vector $vector) {
    // A→×B→=(a2b3−a3b2; a3b1−a1b3; a1b2−a2b1)
    return new self( (($this->j * $vector->k) - ($this->k * $vector->j)),
      (($this->k * $vector->i) - ($this->i * $vector->k)),
      (($this->i * $vector->j) - ($this->j * $vector->i))
    );
  }

  private function isZeroVector(): bool {
    if($this->i == 0 && $this->j == 0 && $this->k == 0) {
      return true;
    }
    return false;
  }

  public function isParallelTo(Vector $vector) {
    if($this->isZeroVector() || $vector->isZeroVector())
      return false;

    $epsilon = 0.0001;

    return
      ( $this->dot($vector) / ( $this->getMagnitude() * $vector->getMagnitude() )) > 1 - $epsilon || ( $this->dot($vector) / ( $this->getMagnitude() * $vector->getMagnitude() )) < -1 + $epsilon ? true : false;
  }

  public function isPerpendicularTo(Vector $vector) {
    if($this->isZeroVector() || $vector->isZeroVector())
      return false;

    return (round($this->dot($vector)) == 0) ? true : false;
  }

  public function normalize() {
    $norm = $this->getMagnitude();

    return new self($this->i / $norm, $this->j / $norm, $this->k / $norm);
  }

  public function isNormalized() {
    return (round($this->getMagnitude())
             == 1) ? true : false;
  }
}