<?php
class Main
{
  static $dir = "Classes/";
  static $classes = array();
  static $prefixClass = "";
  static $suffixClass = "";
  public static function StartClasses()
  {
    $fileSuffix = "php";
    $thisFile = "Main.php";
    $classDir = scandir("./Classes");
    foreach ($classDir as $classDirFile) {
      $file = self::$prefixClass . $classDirFile . self::$suffixClass;
      if ($thisFile != $file && strtolower(pathinfo($file, PATHINFO_EXTENSION)) == $fileSuffix) {
        array_push(self::$classes, $file);
      }
    }
    foreach (self::$classes as $class) {
      $classFile = self::$dir . self::$prefixClass . $class . self::$suffixClass;
      if (file_exists($classFile)) {
        require_once($classFile);
      }
    }
    return "StartClasses process finished!";
  }
}
Main::StartClasses();
?>