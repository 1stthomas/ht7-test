<?php

namespace Ht7\Test\Model;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Description of Method
 *
 * @author Thomas Pluess
 */
abstract class Method extends AbstractLoadable implements ITask
{

    /**
     * The class on which this static method should be triggered.
     *
     * @var     string          The full qualified class name.
     */
    protected $class;

    /**
     * The instance on which this method should be triggered.
     *
     * @var     integer         The id of the instance in the container.
     */
    protected $instance;

    /**
     * The method name.
     *
     * @var     string
     */
    protected $name;

    /**
     * The parameters of the method to call.
     *
     * @var array           An indexed array with the parameter values.
     */
    protected $parameters = [];

    public function addParameter($parameter)
    {
        $this->parameters[] = $parameter;
    }

    /**
     * Get the instance on which the current method should be triggered.
     *
     * @return  string          The class name on which the current static method
     *                          should be called.
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get the instance on which the current method should be triggered.
     *
     * @return  integer         The id on the container of the instance on which
     *                          the current method should be called.
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Get the name of the current method.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    public function setClass($class)
    {
        if (!is_string($class)) {
            $e = 'Unsupported datatype ' . gettype($class) . '.';

            throw new InvalidArgumentException($e);
        }

        $this->class = $class;
    }

    /**
     * Set the instance, on which the current method should be triggered.
     *
     * @param   integer     $instance   The instance where the current method
     *                                  should be called. This is the id from
     *                                  the container place.
     * @throws InvalidArgumentException
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

    /**
     * Set the name of the current method.
     *
     * @param   string      $name           The method name.
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('Unsupported datatype: ' . gettype($name));
        }

        $this->name = $name;
    }

    /**
     * Set the parameters of the current method.
     *
     * @param   array       $parameters     Indexed array of parameter values.
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
