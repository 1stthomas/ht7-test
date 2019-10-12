<?php

namespace Ht7\Test\Model;

use \InvalidArgumentException;
use \Ht7\Test\Utility\Traits\HasId;

/**
 * This is the save into container task.
 *
 * This model class keeps the information to store a variable value into the
 * container.
 *
 * @author Thomas Pluess
 */
class Container extends AbstractLoadable implements ITask
{

    use HasId;

    /**
     * The value of the variable which will be saved into the container.
     *
     * @var string
     */
    protected $value;

    /**
     * Get the variable value.
     *
     * @return  mixed           The variable value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the variable value.
     *
     * @param   mixed       $value      The variable value.
     * @throws InvalidArgumentException
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}
