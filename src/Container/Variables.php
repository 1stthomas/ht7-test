<?php

namespace Ht7\Test\Container;

//use \InvalidArgumentException;

/**
 * Description of Method
 *
 * @author Thomas Pluess
 */
class Variables implements IStorage
{

    /**
     * All variables created while doing tasks.
     *
     * @var     array           Assoc array of variables as values and there id
     *                          as key.
     */
    protected $variables;

    public function __construct()
    {
        $this->variables = [];
    }

    /**
     * Add a pre test task.
     *
     * @param   integer     $id         The id of the variable which is the key
     *                                  of in the container.
     * @param   mixed       $variable   The variable to store.
     */
    public function addVariable($id,
            $variable)
    {
        $this->variables[$id] = $variable;
    }

    /**
     * Get the variable with the defined id.
     *
     * @param   integer     $id
     * @return  mixed
     */
    public function getVariable($id)
    {
        return $this->variables[$id];
    }

    /**
     * Get all defined variables.
     *
     * @return  array           Assoc array of all defined variables as values
     *                          and their ids as keys.
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     *
     * @param   array   $variables      Assoc array of variables as values and
     *                                  their id as keys.
     */
    public function setVariables(array $variables)
    {
        foreach ($variables as $id => $variable) {
            $this->addVariable($id, $variable);
        }
    }

}
