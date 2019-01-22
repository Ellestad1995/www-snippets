<?php
/**
 * Created by PhpStorm.
 * User: joakimellestad
 * Date: 2019-01-17
 * Time: 14:17
 */

/**
 * POST: Større filer og data, inlogging,
 *
 * print_r($POST) // Prints human-readable information about a variable
 *
 */

/**
 * include // programmet fortsetter selv om fila ikke finnes eller
 * require_once // fil bare en gang fila kalles
 */


/**
 * Class
 *
 * self::var // a static reference to object variable
 * this // this objects variable
 */
class MinKlasse {

    public $variabel = "tekst";

    public function __construct()
    {
        echo "Et object av klasse ", __CLASS__, " er opprettet!";
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "Objektet: ", __CLASS__, "er fjernet";
        // unset($obj) kaller på denne
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        echo "Objektet som string";
    }

    public function setProperty($newValue){
        $this->variabel = $newValue;
    }

}