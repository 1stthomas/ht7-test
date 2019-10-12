<?php

namespace Ht7\Test\Model;

use \InvalidArgumentException;
use \Ht7\Test\Model\AbstractLoadable;
use \Ht7\Test\Utility\Traits\HasId;

/**
 * Description of Assertion
 *
 * @author 1stthomas
 */
class Assertion extends AbstractLoadable implements ITask
{

    use HasId;

    /**
     * Assert array has key.
     */
    const ASSERT_ARRAY_HAS_KEY = 1;

    /**
     * Assert class has attribute.
     */
    const ASSERT_CLASS_HAS_ATTRIBUTE = 2;

    /**
     * Assert array subset.
     */
    const ASSERT_ARRAY_SUBSET = 3;

    /**
     * Assert .
     */
    const ASSERT_CLASS_HAS_STATIC_ATTRIBUTE = 4;

    /**
     * Assert .
     */
    const ASSERT_CONTAINS = 5;

    /**
     * Assert .
     */
    const ASSERT_STRING_CONTAINS_STRING = 6;

    /**
     * Assert .
     */
    const ASSERT_STRING_CONTAINS_STRING_IGNORING_CASE = 7;

    /**
     * Assert .
     */
    const ASSERT_CONTAINS_ONLY = 8;

    /**
     * Assert .
     */
    const ASSERT_CONTAINS_ONLY_INSTANCES_OF = 9;

    /**
     * Assert .
     */
    const ASSERT_COUNT = 10;

    /**
     * Assert .
     */
    const ASSERT_DIRECTORY_EXISTS = 11;

    /**
     * Assert .
     */
    const ASSERT_DIRECTORY_IS_READABLE = 12;

    /**
     * Assert .
     */
    const ASSERT_DIRECTORY_IS_WRITABLE = 13;

    /**
     * Assert .
     */
    const ASSERT_EMPTY = 14;

    /**
     * Assert .
     */
    const ASSERT_EQUAL_XML_STRUCTURE = 15;

    /**
     * Assert .
     */
    const ASSERT_EQUALS = 16;

    /**
     * Assert .
     */
    const ASSERT_EQUALS_CANONICALIZING = 17;

    /**
     * Assert .
     */
    const ASSERT_EQUALS_IGNORING_CASE = 18;

    /**
     * Assert .
     */
    const ASSERT_EQUALS_WITH_DELTA = 19;

    /**
     * Assert .
     */
    const ASSERT_FALSE = 20;

    /**
     * Assert .
     */
    const ASSERT_FILE_EQUALS = 21;

    /**
     * Assert .
     */
    const ASSERT_FILE_EXISTS = 22;

    /**
     * Assert .
     */
    const ASSERT_FILE_IS_READABLE = 23;

    /**
     * Assert .
     */
    const ASSERT_FILE_IS_WRITABLE = 24;

    /**
     * Assert .
     */
    const ASSERT_GREATER_THAN = 25;

    /**
     * Assert .
     */
    const ASSERT_GREATER_THAN_OR_EQUAL = 26;

    /**
     * Assert .
     */
    const ASSERT_INFINITE = 27;

    /**
     * Assert .
     */
    const ASSERT_INSTANCE_OF = 28;

    /**
     * Assert .
     */
    const ASSERT_IS_ARRAY = 29;

    /**
     * Assert .
     */
    const ASSERT_IS_BOOL = 30;

    /**
     * Assert .
     */
    const ASSERT_IS_CALLABLE = 31;

    /**
     * Assert .
     */
    const ASSERT_IS_FLOAT = 32;

    /**
     * Assert .
     */
    const ASSERT_IS_INT = 33;

    /**
     * Assert .
     */
    const ASSERT_IS_ITERABLE = 34;

    /**
     * Assert .
     */
    const ASSERT_IS_NUMERIC = 35;

    /**
     * Assert .
     */
    const ASSERT_IS_OBJECT = 36;

    /**
     * Assert .
     */
    const ASSERT_IS_RESOURCE = 37;

    /**
     * Assert .
     */
    const ASSERT_IS_SCALAR = 38;

    /**
     * Assert .
     */
    const ASSERT_IS_STRING = 39;

    /**
     * Assert .
     */
    const ASSERT_IS_READABLE = 40;

    /**
     * Assert .
     */
    const ASSERT_IS_WRITABLE = 41;

    /**
     * Assert .
     */
    const ASSERT_LESS_THAN = 42;

    /**
     * Assert .
     */
    const ASSERT_LESS_THAN_OR_EQUAL = 43;

    /**
     * Assert .
     */
    const ASSERT_NAN = 44;

    /**
     * Assert .
     */
    const ASSERT_NULL = 45;

    /**
     * Assert .
     */
    const ASSERT_OBJECT_HAS_ATTRIBUTE = 46;

    /**
     * Assert .
     */
    const ASSERT_REG_EXP = 47;

    /**
     * Assert .
     */
    const ASSERT_STRING_MATCHES_FORMAT = 48;

    /**
     * Assert .
     */
    const ASSERT_STRING_MATCHES_FORMAT_FILE = 49;

    /**
     * Assert .
     */
    const ASSERT_SAME = 50;

    /**
     * Assert .
     */
    const ASSERT_STRING_ENDS_WITH = 51;

    /**
     * Assert .
     */
    const ASSERT_STRING_EQUALS_FILE = 52;

    /**
     * Assert .
     */
    const ASSERT_STRING_STARTS_WITH = 53;

    /**
     * Assert .
     */
    const ASSERT_THAT = 54;

    /**
     * Assert .
     */
    const ASSERT_TRUE = 55;

    // @todo: Open assertions:
    // assertJsonFileEqualsJsonFile
    // assertJsonStringEqualsJsonFile
    // assertJsonStringEqualsJsonString
    // assertXmlFileEqualsXmlFile
    // assertXmlStringEqualsXmlFile
    // assertXmlStringEqualsXmlString

    /**
     * Assertion type.
     *
     * @var     integer             Use one of the
     *                              <code>self::HT7_TEST_ASSERTION_XXX</code>
     *                              constants.
     */
    protected $type;

    /**
     * Assertion types.
     *
     * @var     array               Array with the related constant value as keys
     *                              and detail informations as values.
     */
    protected static $types = [
        self::ASSERT_ARRAY_HAS_KEY => [
            'method' => 'assertArrayHasKey',
            'name' => 'has key',
            'short' => 'ahk'
        ],
        self::ASSERT_CLASS_HAS_ATTRIBUTE => [
            'method' => 'assertClassHasAttribute',
            'name' => 'class has attribute',
            'short' => 'cha'
        ],
        self::ASSERT_ARRAY_SUBSET => [
            'method' => 'assertArraySubset',
            'name' => 'subset',
            'short' => 'as'
        ],
        self::ASSERT_CLASS_HAS_STATIC_ATTRIBUTE => [
            'method' => 'assertClassHasStaticAttribute',
            'name' => 'class has static attribute',
            'short' => 'chsa'
        ],
        self::ASSERT_CONTAINS => [
            'method' => 'assertContains',
            'name' => 'contains',
            'short' => 'co'
        ],
        self::ASSERT_STRING_CONTAINS_STRING => [
            'method' => 'assertStringContainsString',
            'name' => 'string contains string',
            'short' => 'scs'
        ],
        self::ASSERT_STRING_CONTAINS_STRING_IGNORING_CASE => [
            'method' => 'assertStringContainsStringIgnoringCase',
            'name' => 'string contains string ignoring case',
            'short' => 'scsic'
        ],
        self::ASSERT_CONTAINS_ONLY => [
            'method' => 'assertContainsOnly',
            'name' => 'contains only',
            'short' => 'coo'
        ],
        self::ASSERT_CONTAINS_ONLY_INSTANCES_OF => [
            'method' => 'assertContainsOnlyInstancesOf',
            'name' => 'contains only instances of',
            'short' => 'cooio'
        ],
        self::ASSERT_COUNT => [
            'method' => 'assertCount',
            'name' => 'count',
            'short' => 'cou'
        ],
        self::ASSERT_DIRECTORY_EXISTS => [
            'has_one_param' => true,
            'method' => 'assertDirectoryExists',
            'name' => 'directory exists',
            'short' => 'de'
        ],
        self::ASSERT_DIRECTORY_IS_READABLE => [
            'has_one_param' => true,
            'method' => 'assertDirectoryIsReadable',
            'name' => 'directory is readable',
            'short' => 'dir'
        ],
        self::ASSERT_DIRECTORY_IS_WRITABLE => [
            'has_one_param' => true,
            'method' => 'assertDirectoryIsWritable',
            'name' => 'directory is writable',
            'short' => 'diw'
        ],
        self::ASSERT_EMPTY => [
            'has_one_param' => true,
            'method' => 'assertEmpty',
            'name' => 'empty',
            'short' => 'em'
        ],
        self::ASSERT_EQUAL_XML_STRUCTURE => [
            'method' => 'assertEqualXMLStructure',
            'name' => 'equals XML structure',
            'short' => 'exs'
        ],
        self::ASSERT_EQUALS => [
            'method' => 'assertEquals',
            'name' => 'equals',
            'short' => 'eq'
        ],
        self::ASSERT_EQUALS_CANONICALIZING => [
            'method' => 'assertEqualsCanonicalizing',
            'name' => 'equals canonicalizing',
            'short' => 'eqc'
        ],
        self::ASSERT_EQUALS_IGNORING_CASE => [
            'method' => 'assertEqualsIgnoringCase',
            'name' => 'equals ignoring case',
            'short' => 'eqic'
        ],
        self::ASSERT_EQUALS_WITH_DELTA => [
            'has_three_param' => true,
            'method' => 'assertEqualsWithDelta',
            'name' => 'equals with delta',
            'short' => 'eqwd'
        ],
        self::ASSERT_FALSE => [
            'has_one_param' => true,
            'method' => 'assertFalse',
            'name' => 'false',
            'short' => 'fa'
        ],
        self::ASSERT_FILE_EQUALS => [
            'method' => 'assertFileEquals',
            'name' => 'file equals',
            'short' => 'feq'
        ],
        self::ASSERT_FILE_EXISTS => [
            'has_one_param' => true,
            'method' => 'assertFileExists',
            'name' => 'file exists',
            'short' => 'fex'
        ],
        self::ASSERT_FILE_IS_READABLE => [
            'has_one_param' => true,
            'method' => 'assertFileIsReadable',
            'name' => 'file is readable',
            'short' => 'fir'
        ],
        self::ASSERT_FILE_IS_WRITABLE => [
            'has_one_param' => true,
            'method' => 'assertFileIsWritable',
            'name' => 'file is writable',
            'short' => 'fiw'
        ],
        self::ASSERT_GREATER_THAN => [
            'method' => 'assertGreaterThan',
            'name' => 'greater than',
            'short' => 'grt'
        ],
        self::ASSERT_GREATER_THAN_OR_EQUAL => [
            'method' => 'assertGreaterThanOrEqual',
            'name' => 'greater than or equal',
            'short' => 'grtoeq'
        ],
        self::ASSERT_INFINITE => [
            'has_one_param' => true,
            'method' => 'assertInfinite',
            'name' => 'infinite',
            'short' => 'inf'
        ],
        self::ASSERT_INSTANCE_OF => [
            'method' => 'assertInstanceOf',
            'name' => 'instance of',
            'short' => 'ins'
        ],
        self::ASSERT_IS_ARRAY => [
            'has_one_param' => true,
            'method' => 'assertIsArray',
            'name' => 'is array',
            'short' => 'ia'
        ],
        self::ASSERT_IS_BOOL => [
            'has_one_param' => true,
            'method' => 'assertIsBool',
            'name' => 'is boolean',
            'short' => 'ib'
        ],
        self::ASSERT_IS_CALLABLE => [
            'has_one_param' => true,
            'method' => 'assertIsCallable',
            'name' => 'is callable',
            'short' => 'ic'
        ],
        self::ASSERT_IS_FLOAT => [
            'has_one_param' => true,
            'method' => 'assertIsFloat',
            'name' => 'is float',
            'short' => 'if'
        ],
        self::ASSERT_IS_INT => [
            'has_one_param' => true,
            'method' => 'assertIsInt',
            'name' => 'is integer',
            'short' => 'ii'
        ],
        self::ASSERT_IS_ITERABLE => [
            'has_one_param' => true,
            'method' => 'assertIsIterable',
            'name' => 'is iterable',
            'short' => 'iit'
        ],
        self::ASSERT_IS_NUMERIC => [
            'has_one_param' => true,
            'method' => 'assertIsNumeric',
            'name' => 'is numeric',
            'short' => 'in'
        ],
        self::ASSERT_IS_OBJECT => [
            'has_one_param' => true,
            'method' => 'assertIsObject',
            'name' => 'is object',
            'short' => 'io'
        ],
        self::ASSERT_IS_RESOURCE => [
            'has_one_param' => true,
            'method' => 'assertIsResource',
            'name' => 'is resource',
            'short' => 'ir'
        ],
        self::ASSERT_IS_SCALAR => [
            'has_one_param' => true,
            'method' => 'assertIsScalar',
            'name' => 'is scalar',
            'short' => 'isc'
        ],
        self::ASSERT_IS_STRING => [
            'has_one_param' => true,
            'method' => 'assertIsString',
            'name' => 'is string',
            'short' => 'is'
        ],
        self::ASSERT_IS_READABLE => [
            'has_one_param' => true,
            'method' => 'assertIsReadable',
            'name' => 'is readable',
            'short' => 'ire'
        ],
        self::ASSERT_IS_WRITABLE => [
            'has_one_param' => true,
            'method' => 'assertIsWritable',
            'name' => 'is writable',
            'short' => 'iw'
        ],
        self::ASSERT_LESS_THAN => [
            'method' => 'assertLessThan',
            'name' => 'less than',
            'short' => 'lt'
        ],
        self::ASSERT_LESS_THAN_OR_EQUAL => [
            'method' => 'assertLessThanOrEqual',
            'name' => 'less than or equal',
            'short' => 'ltoeq'
        ],
        self::ASSERT_NAN => [
            'has_one_param' => true,
            'method' => 'assertNan',
            'name' => 'NAN',
            'short' => 'nan'
        ],
        self::ASSERT_NULL => [
            'has_one_param' => true,
            'method' => 'assertNull',
            'name' => 'NULL',
            'short' => 'null'
        ],
        self::ASSERT_OBJECT_HAS_ATTRIBUTE => [
            'method' => 'assertObjectHasAttribute',
            'name' => 'object has attribute',
            'short' => 'oha'
        ],
        self::ASSERT_REG_EXP => [
            'method' => 'assertRegExp',
            'name' => 'regexp',
            'short' => 're'
        ],
        self::ASSERT_STRING_MATCHES_FORMAT => [
            'method' => 'assertStringMatchesFormat',
            'name' => 'string matches format',
            'short' => 'smf'
        ],
        self::ASSERT_STRING_MATCHES_FORMAT_FILE => [
            'method' => 'assertStringMatchesFormatFile',
            'name' => 'string matches format file',
            'short' => 'smff'
        ],
        self::ASSERT_SAME => [
            'method' => 'assertSame',
            'name' => 'same',
            'short' => 'same'
        ],
        self::ASSERT_STRING_ENDS_WITH => [
            'method' => 'assertStringEndsWith',
            'name' => 'string ends with',
            'short' => 'sew'
        ],
        self::ASSERT_STRING_EQUALS_FILE => [
            'method' => 'assertStringEqualsFile',
            'name' => 'string equals file',
            'short' => 'seqf'
        ],
        self::ASSERT_STRING_STARTS_WITH => [
            'method' => 'assertStringStartsWith',
            'name' => 'string starts with',
            'short' => 'ssw'
        ],
        self::ASSERT_THAT => [
            'method' => 'assertThat',
            'name' => 'that',
            'short' => 'that'
        ],
        self::ASSERT_TRUE => [
            'has_one_param' => true,
            'method' => 'assertTrue',
            'name' => 'true',
            'short' => 'true'
        ]
    ];

    /**
     * The value coming from the test.
     *
     * @var     mixed
     */
    protected $valueAsserted;

    /**
     * The expected value of the assertion.
     *
     * @var     mixed
     */
    protected $valueExpected;

    /**
     * Get an instance of the Assertion class.
     *
     * @param   array       $data
     * @param   integer     $type           The assertion type. Use one of the
     *                                      <code>self::HT7_TEST_ASSERTIOM_XXX</code>
     *                                      constants. This property can also be
     *                                      committed by first parameter.
     */
    public function __construct(array $data = [], $type = self::ASSERT_EQUALS)
    {
        if (!isset($data['type'])) {
            $data['type'] = $type;
        }

        parent::__construct($data);
    }

    public function getAssertionInfo()
    {
        if ($this->getType() !== null) {
            return static::$types[$this->getType()];
        }
    }

    public static function getTypes()
    {
        return static::$types;
    }

    /**
     * Get the assertion of the current instance.
     *
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }

    public function getValueAsserted()
    {
        return $this->valueAsserted;
    }

    public function getValueExpected()
    {
        return $this->valueExpected;
    }

    /**
     * Set the assertion type.
     *
     * @param   integer|string  $type       The integer value has to be one of
     *                                      the <code>ASSERT_XXX</code> constants
     *                                      defined by this class. If the type
     *                                      is a string it has to be the short
     *                                      name of the desired assertion type.
     * @throws InvalidArgumentException
     */
    public function setType($type)
    {
        $types = static::getTypes();

        if (is_int($type)) {
            if (key_exists($type, $types)) {
                $this->type = $type;
            } else {
                $e = 'Unsupported assertion type ' . $type . '.';

                throw new InvalidArgumentException($e);
            }
        } elseif (is_string($type)) {
            $typesShort = array_map(function($item) {
                return $item['short'];
            }, $types);

            $key = array_search($type, $typesShort);

            if ($key == false) {
                $e = 'Unsupported assertion short name: ' . $type . '.';

                throw new InvalidArgumentException($e);
            } else {
                $this->type = $key;
            }
        } else {
            $e = 'Unsupported datatype ' . gettype($type) . '.';

            throw new InvalidArgumentException($e);
        }
    }

    public function setValueAsserted($valueAsserted)
    {
        $this->valueAsserted = $valueAsserted;
    }

    public function setValueExpected($valueExpected)
    {
        $this->valueExpected = $valueExpected;
    }

}
