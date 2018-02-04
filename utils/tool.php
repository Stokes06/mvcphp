<?php
namespace Dev;
class Tool{
    /**
     * var_dump d'une variable surrounded with <pre>
     * @param mixed $var
     * @param mixed[] $varopt
     */
   public static function debug($var, $stop=false, ...$varopt){
        print "<pre style='background-color: black; color:white;'>"."\n";
        if($varopt!=null)
            var_dump($var, $varopt);
        else
            var_dump($var);
        print "\n"."</pre>";
        if($stop) die;
    }

  public static function isActive($url, $cible, $tab = []) : string
    {
        return ($url === $cible || in_array($url, $tab)) ? "active" : "";
    }
}
