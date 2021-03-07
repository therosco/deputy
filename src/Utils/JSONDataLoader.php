<?php

namespace Deputy\Utils;

use Deputy\Validators\ValidatorInterface;
use Exception;

/**
 * Class JSONDataLoader
 *
 * Reads and decodes JSON from a given file. If a validator or validators provided would use it to ensure the data correctness
 *
 * This is to avoid code duplication and introduce minimal IO safety checks
 * @package Deputy\Utils
 */
class JSONDataLoader
{
    /** @var ValidatorInterface[] */
    private array $validators = [];

    public function __construct(ValidatorInterface ... $validators) {
        $this->validators = $validators;
    }

    /**
     * @param string $filename a path to the file to load
     * @return mixed json-decoded data
     * @throws Exception
     */
    public function load(string $filename) {
        if (!is_readable($filename)) {
            throw new Exception($filename);
        }

        $result = json_decode(file_get_contents($filename));
        if (json_last_error()) {
            throw new Exception(json_last_error_msg());
        }

        foreach ($this->validators as $validator) {
            if (!$validator->validate($result)) {
                throw new Exception("Validator failed: " . get_class($validator));
            }
        }

        return $result;
    }
}