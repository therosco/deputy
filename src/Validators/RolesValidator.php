<?php

namespace Deputy\Validators;

/**
 * Class RolesValidator
 *
 * A roles validator implementation
 *
 * @package Deputy\Validators
 */
class RolesValidator extends BaseStdClassArrayValidator
{
    protected function getFieldTypeMap(): array
    {
        return [
            'Id'        => 'integer',
            'Name'      => 'string',
            'Parent'    => 'integer',
        ];
    }
}