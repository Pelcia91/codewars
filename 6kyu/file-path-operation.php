/*
	Task:
		This kata requires you to write an object that receives a file path and does operations on it. NOTE FOR PYTHON USERS: You cannot use modules os.path, glob, and re
		The purpose of this kata is to use string parsing, so you're not supposed to import external libraries. I could only enforce this in python.

	Testing:
		$fm = new FileMaster('/Users/person1/Pictures/house.png');
		$fm.extension(); // 'png'
		$fm.filename(); // 'house'
		$fm.dirpath(); // '/Users/person1/Pictures'

	Notes:
		I have other kata that need to be tested. You may find them here and here
		Please post any questions or suggestion in the discourse section. Thank you!
		Thank to all users who contributed to this kata! I appreciate your input!

	Url: https://www.codewars.com/kata/5844e0890d3bedc5c5000e54
*/

class FileMaster {

  private $file;

  public function __construct($filepath){
    $this->file = pathinfo($filepath);
  }

  public function extension() : string {
    return isset($this->file['extension']) ? $this->file['extension'] : '';
  }

  public function filename() : string {
    return isset($this->file['filename']) ? $this->file['filename'] : '';
  }
  public function dirpath() : string {
    return isset($this->file['dirname']) ? $this->file['dirname'].'/' : '';
  }

}