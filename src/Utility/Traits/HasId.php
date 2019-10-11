<?php

namespace Ht7\Test\Utility\Traits;

use \InvalidArgumentException;

/**
 * Handles get and set id.
 *
 * @author      Thomas Plüss
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 * @license http://URL name
 */
trait HasId
{

    protected $id;

    /**
     * Get the id of the current element in the container.
     *
     * @return  integer         The id of the current element in the container.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id of the current element in the container.
     *
     * @param   integer     $id         The id of the current element in the container.
     * @throws  InvalidArgumentException
     */
    public function setId($id)
    {
        if (empty($id)) {
            $e = 'Empty id found.';

            throw new InvalidArgumentException($e);
        } elseif (is_int($id)) {
            $this->id = $id;
        } elseif (is_string($id)) {
            $this->id = trim($id, ['{id:', '}']);
        } else {
            $e = 'Unsupported datatype ' . gettype($id) . '.';

            throw new InvalidArgumentException($e);
        }
    }

}
