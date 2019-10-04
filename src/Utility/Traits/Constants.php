<?php

namespace Ht7\Test\Utility\Traits;

use \ReflectionClass;

/**
 * Handles class constants.
 *
 * @author      Thomas Plüss
 * @since       0.0.1
 * @copyright (c) 2019, Thomas Pluess
 * @license http://URL name
 */
trait Constants
{

    /**
     * Get the defined constants defined by this class.
     *
     * @return  array           Assoc array with the constant names as key and
     *                          the corresponding values as values.
     * @link https://stackoverflow.com/questions/956401/can-i-get-consts-defined-on-a-php-class
     */
    public static function getConstants()
    {
        $reflection = new ReflectionClass(get_called_class());
        $constants = $reflection->getConstants();
        $parent = $reflection->getParentClass();

        while (is_object($parent)) {
            $constants = array_merge($constants, $parent->getConstants());

            $parent = $parent->getParentClass();
        }

        return $constants;
    }

    /**
     * Get all constants defined by this class with a specific prefix.
     *
     * @param   string      $type       The prefix to search for.
     * @return  array
     */
    public static function getConstantsByType($type)
    {
        $constantsAll = static::getConstants();

        if (!empty($type)) {
            $constants = [];

            foreach ($constantsAll as $name => $value) {
                if (is_array($type) && !empty($type[0])) {
                    $type = $type[0];
                }

                if (strpos($name, $type) !== false) {
                    $constants[$name] = $value;
                }
            }
        } else {
            $constants = $constantsAll;
        }

        return $constants;
    }

}
