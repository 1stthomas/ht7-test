<?php

namespace Ht7\Test\Tests\Utility\Model;

use \Ht7\Test\Model\AbstractLoadable;

/**
 * This is a helper class for testcases which change public properties.
 *
 * @author Thomas Pluess
 */
class ObjTestWithPublicVariable extends AbstractLoadable
{

    /**
     * The public property.
     *
     * @var     mixed
     */
    public $testPublic;

    /**
     * The protected property.
     *
     * @var     mixed
     */
    protected $testProtected;

    /**
     * Simple get method to recive the value of the protected property.
     *
     * @return  mixed
     */
    public function getTestProtected()
    {
        return $this->testProtected;
    }

    /**
     * Simple set method to redefine the value of the protected property.
     *
     * @param   mixed   $testProtected
     */
    public function setTestProtected($testProtected)
    {
        $this->testProtected = $testProtected;
    }

}
