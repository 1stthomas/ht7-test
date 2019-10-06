<?php

namespace Ht7\Test\Utility\Traits;

use \InvalidArgumentException;

/**
 * This trait provides some basic validation methods.
 *
 * To use this trait will gain you consistent error messages through the whole
 * application.
 *
 * @author          Thomas Pluess
 * @since           0.0.1
 * @version         0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
trait ValidationBase
{

    /**
     * @var     integer         This variable controls the output of occured
     *                          validation fails.
     */
    protected $validationReportType = 1;

    /**
     * Set the output type of validation fails.
     *
     * @param   integer     $reportType     Controls the output of validation fails.
     *                                      1 will throw an \InvalidArgumentException,
     *                                      2 will return an error string.
     *                                      3 or everthing else will return
     *                                      <code>false</code>.
     */
    public function setValidationReportType($reportType)
    {
        if ($reportType === 1 || $reportType === 2) {
            $this->validationReportType = $reportType;
        } else {
            $this->validationReportType = 3;
        }
    }

    /**
     * Validate the datatype of a certain variable and throw an exception if
     * it is not contained within the defined datatypes.
     *
     * @param   mixed       $value      The value to validate its datatype.
     * @param   array       $types      The supported datatypes.
     * @param   string      $name       The name to display on the exception.
     * @return  boolean                 True if the validation passed.
     * @throws  InvalidArgumentException
     */
    public function validateDatatype($value, array $types, $name)
    {
        if (!in_array(gettype($value), $types)) {
            $e = 'Unsupported datatype ' . gettype($value);
            $e .= empty($name) ? '' : ' for variable ' . $name . '. ';
            $e .= count($types) > 1 ? 'One of the following needed: ' . implode(', ', $types) . '.' : ucfirst($types[0]) . ' needed.';

            return $this->handleReport($e);
        }

        return true;
    }

    /**
     * Validate the value of the variable if it is empty.
     *
     * @param   mixed       $value      The value to validate.
     * @param   string      $name       The property name.
     * @return  boolean                 True if the validation passed. Otherwise
     *                                  an output according to
     *                                  <code>$this->validationReportType</code>
     * @throws  InvalidArgumentException
     */
    public function validateNotEmpty($value, $name)
    {
        if (empty($value)) {
            $e = 'Empty ' . $name . ' found.';

            return $this->handleReport($e);
        }

        return true;
    }

    /**
     * Handle the output of the validation error message.
     *
     * This method will handle the output according to <code>$this->validationReportType</code>.
     *
     * @param   string      $e          The validation error message.
     * @return  boolean                 Only the report type 3 will return false.
     *                                  All others will throw an exception.
     * @throws  InvalidArgumentException
     */
    protected function handleReport($e)
    {
        if ($this->validationReportType === 1) {
            throw new InvalidArgumentException($e);
        } elseif ($this->validationReportType === 2) {
            return $e;
        } else {
            return false;
        }
    }

}
