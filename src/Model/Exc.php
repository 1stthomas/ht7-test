<?php

namespace Ht7\Test\Model;

use \InvalidArgumentException;

/**
 * Description of Method
 *
 * @author Thomas Pluess
 */
class Exc extends AbstractLoadable implements ITask
{

    /**
     * The exception class.
     *
     * @var string
     */
    protected $class;

    /**
     * Get the instance on which the current method should be triggered.
     *
     * @return  string          The exception class.
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the instance, on which the current method should be triggered.
     *
     * @param   string      $class       The exception class.
     * @throws InvalidArgumentException
     */
    public function setClass($class)
    {
        if (!is_string($class)) {
            $e = 'Unsupported datatype ' . gettype($class);

            throw new InvalidArgumentException($e);
        }

        $this->class = $class;
    }

}
