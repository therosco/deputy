<?php

namespace Tests\DataStructures;

use Deputy\DataStructures\ManyToOneStorage;
use PHPUnit\Framework\TestCase;

/**
 * Class ManyToOneStorageTest
 *
 * Tests ManyToOneStorage
 *
 * @package Tests\DataStructures
 */
class ManyToOneStorageTest extends TestCase
{
    public function getByRelatedDataProvider(): array {
        return [
            [
                [
                    [1, 1, true],
                    [2, 1, false],
                    [3, 2, true],
                    [4, 3, true],
                ],
                1,
                [true, false]
            ],
            [
                [
                    [1, 1, true],
                    [2, 1, false],
                    [3, 2, true],
                    [4, 1, true],
                ],
                1,
                [true, false, true]
            ],
        ];
    }

    /**
     * @dataProvider getByRelatedDataProvider
     *
     * Tests getByRelatedId() method
     *
     * @param array $items
     * @param int $relatedId
     * @param array $expected
     */
    public function testGetByRelatedId(array $items, int $relatedId, array $expected): void {
        $storage = $this->loadItems($items);

        $this->assertEquals($expected, $storage->getByRelatedId($relatedId));
    }

    public function getByIdProvider(): array {
        return [
            [
                [
                    [1, 1, true],
                    [2, 1, false],
                ],
                1,
                true
            ],
            [
                [
                    [1, 1, true],
                    [2, 1, false],
                ],
                2,
                false
            ],
            [
                [
                    [1, 1, true],
                    [2, 1, false],
                ],
                5,
                null
            ],
        ];
    }

    /**
     * @dataProvider getByIdProvider
     *
     * Tests getById() method
     *
     * @param array $items
     * @param int $id
     * @param array $expected
     */
    public function testGetById(array $items, int $id, ?bool $expected): void {
        $storage = $this->loadItems($items);

        $this->assertEquals($expected, $storage->getById($id));
    }

    /**
     * @param array $items
     * @return ManyToOneStorage
     */
    private function loadItems(array $items): ManyToOneStorage
    {
        $storage = new ManyToOneStorage();
        foreach ($items as $item) {
            $storage->add($item[0], $item[1], $item[2]);
        }
        return $storage;
    }
}