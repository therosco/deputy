<?php

namespace Tests;

use Deputy\UserHierarchy;
use Deputy\Utils\JSONDataLoader;
use PHPUnit\Framework\TestCase;

/**
 * Class UserHierarchyTest
 *
 * Tests the main logic part
 *
 * @package Tests
 */
class UserHierarchyTest extends TestCase {

    /**
     * Contains the output from the exercise description
     *
     * @return array[]
     */
    public function dataProvider(): array {
        return [
            [
                3,
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
                ]
            ],
            [
                1,
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
                    (object)[
                        "Id"    => 3,
                        "Name"  => "Sam Supervisor",
                        "Role"  => 3
                    ],
                    (object)[
                        "Id"    => 4,
                        "Name"  => "Mary Manager",
                        "Role"  => 2
                    ],
                ]
            ]
        ];
    }

    /**
     * An integration test
     *
     * @dataProvider dataProvider
     * @param int $userId
     * @param array $expected
     * @throws \Exception
     */
    public function testUserHierarchy(int $userId, array $expected): void {
        $dataPath = dirname(__FILE__) . '/../data/';
        $usersFile = $dataPath . 'users.json';
        $rolesFile = $dataPath . 'roles.json';

        $roles = (new JSONDataLoader())->load($rolesFile);
        $users = (new JSONDataLoader())->load($usersFile);
        $userHierarchy = new UserHierarchy();
        $userHierarchy->setUsers($users);
        $userHierarchy->setRoles($roles);

        // The order is not important
        $this->assertEqualsCanonicalizing($expected, $userHierarchy->getSubOrdinates($userId));
    }
}