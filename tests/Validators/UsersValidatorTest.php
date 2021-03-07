<?php

namespace Validators;

use Deputy\Validators\UsersValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class UsersValidatorTest
 *
 * UsersValidator testing
 *
 * @package Validators
 */
class UsersValidatorTest extends TestCase
{
    public function usersProvider(): array {
        return [
            "valid" => [
                [
                    (object)[
                        "Id"    => 2,
                        "Name"  => "Emily Employee",
                        "Role"  => 4
                    ],
                    (object)[
                        "Id"    => 5,
                        "Name"  => "Steve Trainer",
                        "Role"  => 5
                    ],
                ],
                true,
            ],
            "invalid type" => [
                [
                    (object)[
                        "Id"    => 2,
                        "Name"  => "Emily Employee",
                        "Role"  => 4
                    ],
                    (object)[
                        "Id"    => 5,
                        "Name"  => "Steve Trainer",
                        "Role"  => "5"
                    ],
                ],
                false,
            ],
            "invalid structure" => [
                [
                    (object)[
                        "Id"    => 2,
                        "Role"  => 4
                    ],
                    (object)[
                        "Id"    => 5,
                        "Name"  => "Steve Trainer",
                        "Role"  => 5
                    ],
                ],
                false,
            ],
            "not stdClass" => [
                [
                    (object)[
                        "Id"    => 2,
                        "Name"  => "Emily Employee",
                        "Role"  => 4
                    ],
                    [
                        "Id"    => 5,
                        "Name"  => "Steve Trainer",
                        "Role"  => 5
                    ],
                ],
                false,
            ],
        ];
    }

    /**
     * @dataProvider usersProvider
     *
     * @param array $users
     * @param bool $expected
     */
    public function testValidation(array $users, bool $expected): void {
        $this->assertEquals($expected, (new UsersValidator())->validate($users));
    }
}