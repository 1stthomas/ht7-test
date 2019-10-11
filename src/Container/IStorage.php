<?php

namespace Ht7\Test\Container;

/**
 *
 * @author Thomas Pluess
 */
interface IStorage
{

    public function addVariable($id,
            $variable);

    public function getVariable($id);

    public function getVariables();

    public function setVariables(array $variables);
}
