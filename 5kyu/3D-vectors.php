/*
About
    This Kata Series is aimed at representing mathematical concepts using code and writing programs to solve simple, typical mathematical problems. The solutions to these Kata may or may not be helpful in programming your own maths-based application.

Task
    Declare and define a Vector class/struct which represents a vector in three-dimensional space. This class/struct should have three public (i.e. accessible anywhere within the program/script) properties i/I, j/J and k/K.

    The Vector class/struct should have a class/struct constructor which accepts exactly three arguments, all of which are required, in the following order: i/I, j/J, k/K, and assign the values of the arguments to the public properties i/I, j/J and k/K respectively. It is expected that all three arguments will be valid numbers (integers and/or floats, doesn't matter) but no type checking is required on your part.

    The magnitude of a Vector is often very important to know. For example, if the velocity of a car is represented by a three-dimensional Vector, its magnitude tells us the speed at which it is moving. Declare and define a public method getMagnitude/GetMagnitude/get_magnitude which accepts no arguments and returns the magnitude of the vector. Rounding will not be required as the test cases will allow for potential floating point errors.

    The unit vectors in the x, y and z directions of the coordinate axes are commonly denoted as i, j and k respectively. These three unit vectors are considered especially important in mathematics as they are the basis of the definitions of every other vector in 3D space. Define three public, static (i.e. directly invoked from the class itself) methods getI/GetI/get_i, getJ/GetJ/get_j and getK/GetK/get_k, each of which accepts no arguments and returns Vector objects representing the unit vectors i, j and k respectively.

    A common vector operation is vector addition where two vectors are added together to give a resultant vector. Declare and define a public method add/Add which accepts exactly 1 required argument, another instance of Vector (no type checking required), and returns an instance of Vector which is the sum of the two vectors.

    Another common vector operation is scalar multiplication where a vector is enlarged by a scalar. Declare and define a public method multiplyByScalar/MultiplyByScalar/multiply_by_scalar which accepts exactly 1 required argument, a number (integer or float, doesn't matter), and returns an instance of Vector which is the original vector multiplied by that scalar.

    The dot product, also commonly known as the scalar product of two vectors, is also very useful at determining things such as the angle between the two vectors. Declare and define a public method dot/Dot which accepts exactly 1 required argument, another instance of Vector (no type checking required), and returns the dot product between the two vectors. No rounding is necessary as the test cases will allow for potential floating point errors.

    The cross product is often even more useful than the dot product as it gives a vector that is orthogonal (i.e. perpendicular) to both vectors involved. Another application of the cross product includes finding the area of a pallelogram formed by the two vectors. Declare and define a public method cross/Cross which accepts exactly 1 required argument, another instance of Vector (no type checking required), and returns an instance of Vector which is the cross product of the two vectors involved in the order that the code would be read. For example, $a->cross($b)/a.cross(b)/a.Cross(b) would return the result of a × b NOT b × a.

    Now that we have defined our basic operations for our Vector class, it is time to move on to something more exciting. Declare and define a public method isParallelTo/IsParallelTo/is_parallel_to which receives exactly 1 required argument, another instance of Vector (no type checking required), and returns a boolean on whether the two vectors involved are parallel (or antiparallel) to each other. Note, however, in the edge case where either (or both) vector is a zero vector, your method should return false because you can't really define the direction of a zero vector, can you? Also note that your method should account for potential floating point errors if necessary. Don't worry, very small values (e.g. <= 0.001) will not be deliberately tested in the test cases to trip up your method ;)

    It is also often very useful to know whether two vectors are perpendicular to each other. Declare and define a public method isPerpendicularTo/IsPerpendicularTo/is_perpendicular_to which accepts exactly 1 required argument, another instance of Vector (no type checking required), and returns a boolean on whether the two vectors involved are perpendicular to each other. Note, however, in the edge case where either (or both) vector is a zero vector, your method should return false as you can't really define the direction of a zero vector, can you? This method should also be able to handle potential floating point errors correctly.

    Apart from the standard unit vectors i, j and k, other unit vectors can also prove to be very useful. Declare and define a public method normalize/Normalize which accepts no arguments and returns a normalized version of said vector. The tests will allow for potential floating point errors.

    Finally, declare and define a public method isNormalized/IsNormalized/is_normalized which accepts no arguments and returns a boolean stating whether the given vector is normalized (i.e. has unit length). Your method should account for potential floating point errors.

    Url: https://www.codewars.com/kata/program-a-calculator-number-2-3d-vectors/php
*/

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