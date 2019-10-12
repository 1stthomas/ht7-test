<?php

namespace Ht7\Test\Model;

use \InvalidArgumentException;

//use Loadable;

/**
 * This abstract class provides a way to load its properties by adding an assoc
 * array as a parameter on its constructor.
 *
 * @author 1stthomas
 */
abstract class AbstractLoadable implements Loadable
{

    public function __construct(array $data)
    {
        $this->load($data);
    }

    /**
     * Load the current instance with the present variable data.
     *
     * This method will only load variables for which there is a defined set
     * method. Otherwise an exception will be trown.
     *
     * @param   array   $data           Assoc array with the variable names as key and
     *                                  the corresponding values as value.
     * @throws  InvalidArgumentException
     */
    public function load(array $data)
    {

        foreach ($data as $name => $value) {
            $method = 'set' . ucfirst($name);

            if (method_exists(static::class, $method)) {
                $this->$method($value);
            } else {
                throw new InvalidArgumentException('Unsupported property: ' . $name);
            }
        }
    }

}
