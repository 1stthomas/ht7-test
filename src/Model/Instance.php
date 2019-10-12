<?php

namespace Ht7\Test\Model;

use \InvalidArgumentException;
use \Ht7\Test\Utility\Traits\HasId;

/**
 * Description of Method
 *
 * @author Thomas Pluess
 */
class Instance extends AbstractLoadable implements ITask, IContainerElement
{

    use HasId;

    /**
     * The class name, of which a new intance should be created.
     *
     * @var object
     */
    protected $class;

    /**
     * The parameters of the constructor call.
     *
     * @var array           An indexed array with the parameter values.
     */
    protected $parameters = [];

    public function addParameter($parameter)
    {
        $this->parameters[] = $parameter;
    }

    /**
     * Get the class name, of which a new intance should be created.
     *
     * @return  object          The instance on which the current method should
     *                          be called.
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get the parameter with the submitted name.
     *
     * @param   int     $index          The index of the parameter to retrieve.
     * @return  mixed                   The searched parameter.
     * @throws InvalidArgumentException
     */
    public function getParameter($index)
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('Unsupported datatype: ' . gettype($index));
        }

        return $this->parameters[$index];
    }

    /**
     * Get the parameters of the current method.
     *
     * @return  array                   Indexed array of parameter values.
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set the class name, of which a new intance should be created.
     *
     * @param   string      $class      The class of which an instance should be
     *                                  created.
     * @throws InvalidArgumentException
     */
    public function setClass($class)
    {
        if (!is_string($class)) {
            $e = 'Unsupported datatype ' . gettype($class) . '.';

            throw new InvalidArgumentException($e);
        }

        $this->class = $class;
    }

    /**
     * Set the parameters for the constructor method.
     *
     * @param   array       $parameters     Indexed array of parameter values.
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
