<?php
interface Car {
    public function getMake();
    public function getModel();
  }
  
  class Honda implements Car {
    public function getMake() {
      return "Honda";
    }
  
    public function getModel() {
      return "Civic";
    }
  }
  
  class Toyota implements Car {
    public function getMake() {
      return "Toyota";
    }
  
    public function getModel() {
      return "Corolla";
    }
  }
  
  class CarFactory {

    

    public static function create($make) {
      switch ($make) {
        case "Honda":
          return new Honda();
        case "Toyota":
          return new Toyota();
        default:
          throw new Exception("Unknown car make");
      }
    }
  }
  
  $car1 = CarFactory::create("Honda");
  echo $car1->getMake() . " " . $car1->getModel(); // output: Honda Civic
  
  $car2 = CarFactory::create("Toyota");
  echo $car2->getMake() . " " . $car2->getModel(); // output: Toyota Corolla
?>