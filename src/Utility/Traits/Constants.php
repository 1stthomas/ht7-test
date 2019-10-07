<?php

namespace Ht7\Test\Utility\Traits;

use \ReflectionClass;

/**
 * Handles class constants.
 *
 * @author      Thomas Plüss
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 * @license http://URL name
 */
trait Constants
{

    private static $cacheConstants;
    private static $cacheIncludeAncestors;

    /**
     * Get the constants defined by this class or its ancestors.
     *
     * @param   boolean     $includeAncestors   True if also constants from anscestors should be included.
     * @return  array                           Assoc array with the constant names as key and
     *                                          the corresponding values as values.
     * @since   0.0.1
     * @link https://stackoverflow.com/questions/956401/can-i-get-consts-defined-on-a-php-class
     * @todo    If someone reassigns a constant in a child class, setting
     *          <code>$icludeAncestors = false</code> could produce unexpected results.
     */
    public static function getConstants($includeAncestors = true)
    {
        $cache = static::getCacheConstants();

        $cacheC = $cache[0] === null ? [] : $cache[0];
        $cacheIA = $cache[1] === null ? [] : $cache[1];

        $calledClass = get_called_class();

        if (!array_key_exists($calledClass, $cacheC) || $cacheIA[$calledClass] !== $includeAncestors) {
            $reflection = new ReflectionClass($calledClass);
            // Get an assoc array of all constants, also the ones defined by ancestors.
            $constants = $reflection->getConstants();

            if (!$includeAncestors) {
                // Look for a parent class.
                $parent = $reflection->getParentClass();

                if (is_object($parent)) {
                    // Get all constants of the parent with its ancestors.
                    $constantsParent = $parent->getConstants();
                    // Remove the constants from the ancestors.
                    $constants = array_diff_assoc($constants, $constantsParent);
                }
            }

            static::setCacheConstants($calledClass, $constants, $includeAncestors);
        } else {
            $constants = $cacheC[$calledClass];
        }

        return $constants;
    }

    /**
     * Get all constants defined by this class or its ancestors with a specific prefix.
     *
     * @param   string      $type               The prefix to search for.
     * @param   boolean     $includeAncestors   True if also constants from anscestors should be included.
     * @return  array
     * @since   0.0.1
     */
    public static function getConstantsByType($type, $includeAncestors = true)
    {
        $constantsAll = static::getConstants($includeAncestors);

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

    protected static function getCacheConstants()
    {
        return [
            self::$cacheConstants,
            self::$cacheIncludeAncestors
        ];
    }

    protected static function setCacheConstants($calledClass, $constants, $includeAncestors)
    {
        self::$cacheConstants[$calledClass] = $constants;
        self::$cacheIncludeAncestors[$calledClass] = $includeAncestors;
    }

}
