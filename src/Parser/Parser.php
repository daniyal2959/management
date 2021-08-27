<?php


namespace IAMdaniyal\Management\Parser;


use IAMdaniyal\Management\Generator\Generator;
use Illuminate\Support\Str;

/**
 * Class Parser
 * @package IAMdaniyal\Management\Parser
 *
 * parse scheme option to necessary data
 * more details described in parse method comment
 */
class Parser
{
    private $parsed = [
        'validation' => [],
        'fields' => [],
        'factory' => [],
        'migration' => []
    ];
    private $name;
    private $scheme;
    private $seedCount;

    public function __construct($name, $scheme, $seedCount)
    {
        $this->name = $name;
        $this->scheme = $scheme;
        $this->seedCount = $seedCount;
    }

    /**
     * @param false $doParse
     *
     * this method parse scheme option in crud:create command. if scheme option not exist in current command,
     * parse process not occur and go to next step.
     * maybe you want to this command process migration scheme and parse it to:
     *     1: Request Validation
     *     2: Controller store & update
     *     3: Factory faker data
     * so the second parameter ask you this process
     */
    public function parse($doParse = true)
    {
        $scheme = $this->scheme;

        if(!is_null($scheme)) {
            $options = explode(',', $scheme);
            foreach ($options as $i => $option) {
                $structure = explode(':', $option);

                $this->parsed['migration'][] = $this->parseToMigration($structure);
                if ($doParse) {
                    $this->parsed['fields'][] = $this->parseToFields($structure);
                }
            }
        }


        $generator = new Generator(
            $this->name,
            $this->parsed,
            $this->seedCount,
        );
        $generator->generate();
    }

    /**
     * @param $structure
     *
     * this function parse scheme option to Request Validation data
     */
    public function parseToValidation($structure)
    {

    }

    /**
     * @param $structure
     *
     * this function parse scheme option to store and update controller Model
     */
    public function parseToFields($structure)
    {
        $optionName = $structure[0];

        return '$'.$this->name.'->'.$optionName. ' = $request->'.$optionName.';';
    }

    /**
     * @param $structure
     *
     * this function parse scheme option to factory data
     */
    public function parseToFactory($structure)
    {

    }

    /**
     * @param $structure
     *
     * this function parse scheme option to migration fields
     * structure[0] = name -> required
     * structure[1] = type -> required
     * structure[2] = nullable status -> optinal -> default: not null
     */
    public function parseToMigration($structure)
    {
        $result = '$table->';
        $optionName = $structure[0];
        $optionType = $structure[1];
        $result .= $optionType . "('$optionName'";

        if (isset($structure[2]))
            $result .= ',' . $structure[2];

        $result .= ')';

        if (isset($structure[3])) {
            $result .= '->nullable()';
        }

        $result .= ';';

        return $result;
    }

}
