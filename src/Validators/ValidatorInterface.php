<?php


namespace Deputy\Validators;

/**
 * Interface ValidatorInterface
 *
 * A general input validation interface
 *
 * @package Deputy\Validators
 */
interface ValidatorInterface
{
    public function validate($data): bool;
}