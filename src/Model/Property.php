<?php

namespace Ht7\Test\Model;

use \InvalidArgumentException;
use \Ht7\Test\Utility\Traits\HasId;

/**
 * Description of Method
 *
 * @author Thomas Pluess
 */
class Property extends AbstractLoadable implements ITask
{

    use HasId;

    /**
     * The instance of the property to gain.
     *
     * @var integer
     */
    protected $instance;

    /**
     * The name of the property.
     *
     * @var string
     */
    protected $name;

    /**
     * Get id of the instance in the container.
     *
     * @return  integer         The container element id of the instance with
     *                          the searched property.
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Get the property name.
     *
     * @return  string          The property name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the property name.
     *
     * @param   string      $instance       The property name.
     * @throws InvalidArgumentException
     */
    public function setInstance($instance)
    {
        if (is_string($instance)) {
            $instance = trim(trim($instance, '{id:'), '}');
        } elseif (!is_int($instance)) {
            $e = 'Unsupported datatype ' . gettype($instance);

            throw new InvalidArgumentException($e);
        }

        $this->instance = $instance;
    }

    /**
     * Set the property name.
     *
     * @param   string      $name       The property name.
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            $e = 'Unsupported datatype ' . gettype($name);

            throw new InvalidArgumentException($e);
        }

        $this->name = $name;
    }

}
