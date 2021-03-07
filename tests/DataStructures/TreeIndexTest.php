<?php

namespace Tests\DataStructures;

use Deputy\DataStructures\TreeIndex;
use PHPUnit\Framework\TestCase;

/**
 * Class TreeIndexTest
 *
 * Tests for TreeIndex data structure
 *
 * @package Tests\DataStructures
 */
class TreeIndexTest extends TestCase
{
    public function treeProvider(): array {
        return [
            "simple" => [
                [
                    [1, 0],
                    [2, 1],
                    [3, 1],
                    [4, 2],
                ],
                2,
                [4]
            ],
            "subtree" => [
                [
                    [1, 0],
                    [2, 1],
                    [3, 1],
                    [4, 2],
                ],
                1,
                [2, 3, 4]
            ],
            "parallel hierarchies" => [
                [
                    [1, 0],
                    [2, 1],
                    [3, 1],
                    [4, 2],
                    [5, 0],
                    [6, 5]
                ],
                1,
                [2, 3, 4]
            ]
        ];
    }

    /**
     * @dataProvider treeProvider
     * @param array $items
     * @param int $targetId
     * @param array $expected
     * @throws \Exception
     */
    public function testSubtreeResolution(array $items, int $targetId, array $expected): void {
        $tree = new TreeIndex();
        foreach ($items as $item) {
            $tree->addNode($item[0], $item[1]);
        }

        // The order is not important
        $this->assertEqualsCanonicalizing($expected, $tree->findChildrenNodes($targetId));
    }

    /**
     * @dataProvider treeProvider
     * @param array $items
     * @param int $targetId
     * @param array $expected
     * @throws \Exception
     */
    public function testSubtreeResolutionUnknownElement(array $items, int $targetId, array $expected): void {
        $tree = new TreeIndex();
        foreach ($items as $item) {
            $tree->addNode($item[0], $item[1]);
        }

        $this->expectException(\Exception::class);
        // The order is not important
        $this->assertEqualsCanonicalizing($expected, $tree->findChildrenNodes(99));
    }
}