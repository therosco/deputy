<?php

namespace Deputy\Validators;

use stdClass;

/**
 * Class BaseStdClassArrayValidator
 *
 * A class to contain common validation behaviour
 *
 * @package Deputy\Validators
 */
abstract class BaseStdClassArrayValidator implements ValidatorInterface
{
    /**
     * @return array a map with field name as a key and data dype as a value
     */
    abstract protected function getFieldTypeMap(): array;

    public function validate($data): bool
    {
        if (!is_array($data)) {
            return false;
        }

        $fieldTypeMap = $this->getFieldTypeMap();

        foreach ($data as $item) {
            if (!($item instanceof stdClass)) {
                return false;
            }

            foreach ($fieldTypeMap as $property => $type) {
                if (!property_exists($item, $property) || gettype($item->{$property}) !== $type) {
                    return false;
                }
            }
        }

        return true;
    }
}