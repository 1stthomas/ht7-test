<?php

namespace Ht7\Test\Tests\Utility\Traits;

use \InvalidArgumentException;

/**
 * Test class for the Exception model class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
trait CanDoTest
{

    protected $isDebug = false;

    public function getIsDebug()
    {
        return $this->isDebug;
    }

    public function setIsDebug($isDebug)
    {
        $this->isDebug = $isDebug ? true : false;
    }

    protected function makeTest(array $calls)
    {
        $testObj = null;

        foreach ($calls as $data) {
            if (!empty($data['exception'])) {
                $this->expectException($data['exception']);
            }

            if ($this->getIsDebug()) {
                print_r("\n\nTest run data:\n");
                print_r($data);
                print_r("\n");
            }

            if (!empty($data['class'])) {
                if ($data['class'] === 'object') {
                    $testObj = $this->object;
                } else {
                    if (empty($data['parameters_constructor'])) {
                        $testObj = new $data['class']();
                    } else {
                        // @see https://stackoverflow.com/questions/8734522/dynamically-call-class-with-variable-number-of-parameters-in-the-constructor#answer-8735314
                        $testObj = new $data['class'](...$data['parameters_constructor']);
                    }
                }
            }

            if (!empty($data['class_tasks'])) {
                foreach ($data['class_tasks'] as $task) {
                    if (!empty($task['method'])) {
                        $parameters = empty($task['parameters']) ? [] : $task['parameters'];

                        call_user_func_array([$testObj, $task['method']], $parameters);
                    }
                }
            }

            $data['parameters'] = empty($data['parameters']) ? [] : $data['parameters'];

            if (empty($data['method_is_core']) || !$data['method_is_core']) {
                $testValue = call_user_func_array([$testObj, $data['methodName']], $data['parameters']);
            } else {
                $data['method_name']($data['parameters']);
            }

            if ($this->getIsDebug()) {
                print_r("\n\ntestValue:\n");
                print_r($testValue);
                print_r("\ncompare:\n");
                print_r($data['compareData']);
                print_r("\nclass testObj:\n");
                print_r(get_class($testObj));
                print_r("\n\n");
            }

            if ($data['assertion'] === 'eq') {
                $this->assertEquals($testValue, $data['compareData']);
            }
        }
    }

}
