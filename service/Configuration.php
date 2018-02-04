<?php
namespace Service;
class Configuration{

    protected $ini_array;
    protected static $configuration;
    /**
     * Configuration constructor.
     */
    private function __construct()
    {
        $this->ini_array = parse_ini_file(__DIR__."/../config/config.ini");
    }

    /**
     * Magical Method
     * @param $name
     * @param $arguments
     * @return mixed
     */
   public function __call($name, $arguments)
   {
       //remove first get
       $name = preg_replace("/^get/", "", $name);
       $name = strtolower($name);
       return $this->ini_array[$name];
   }

    public static function getConfig(){
    return  self::$configuration ?? self::$configuration = new Configuration();
    }
}