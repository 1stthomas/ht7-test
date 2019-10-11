<?php

namespace Ht7\Test\Model;

/**
 * This interface indicates, the implementing class supports loading its properties
 * from an assoc array.
 *
 * The <code>load</code> method normally should call the related get method of
 * the key names. If a mehtod is not implemented, it is a good practice, to throw
 * an exception.
 *
 * @author 1stthomas
 */
interface Loadable
{

    /**
     * Load the current instance with the present data array.
     *
     * @param   array       $data       The data to be added to the current instance.
     */
    public function load(array $data);
}
