<?php

namespace Deputy\Validators;

/**
 * Class UsersValidator
 *
 * A users validator implementation
 *
 * @package Deputy\Validators
 */
class UsersValidator extends BaseStdClassArrayValidator
{
    protected function getFieldTypeMap(): array
    {
        return [
            'Id'    => 'integer',
            'Name'  => 'string',
            'Role'  => 'integer',
        ];
    }
}