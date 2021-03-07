<?php


namespace Validators;


use Deputy\Validators\RolesValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class RolesValidatorTest
 *
 * RolesValidator testing
 *
 * @package Validators
 */
class RolesValidatorTest extends TestCase
{
    public function rolesProvider(): array {
        return [
            "valid" => [
                [
                    (object)[
                        "Id"    => 1,
                        "Name"  => "System Administrator",
                        "Parent"  => 0
                    ],
                    (object)[
                        "Id"    => 2,
                        "Name"  => "Location Manager",
                        "Parent"  => 1
                    ],
                ],
                true,
            ],
            "invalid type" => [
                [
                    (object)[
                        "Id"    => 1,
                        "Name"  => "System Administrator",
                        "Parent"  => '0'
                    ],
                    (object)[
                        "Id"    => 2,
                        "Name"  => "Location Manager",
                        "Parent"  => 1
                    ],
                ],
                false,
            ],
            "invalid structure" => [
                [
                    (object)[
                        "Id"    => 1,
                        "Name"  => "System Administrator",
                        "Parent"  => 0
                    ],
                    (object)[
                        "Id"    => 2,
                    ],
                ],
                false,
            ],
            "not stdClass" => [
                [
                    (object)[
                        "Id"    => 1,
                        "Name"  => "System Administrator",
                        "Parent"  => 0
                    ],
                    null
                ],
                false,
            ],
        ];
    }

    /**
     * @dataProvider rolesProvider
     *
     * @param array $roles
     * @param bool $expected
     */
    public function testValidation(array $roles, bool $expected): void {
        $this->assertEquals($expected, (new RolesValidator())->validate($roles));
    }
}