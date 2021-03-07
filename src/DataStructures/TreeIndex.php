<?php

namespace Deputy\DataStructures;

use Exception;

/**
 * Class TreeIndex
 *
 * A data structure to store a tree and resolve a subtree by a given key
 *
 * @package Deputy\DataStructures
 */
class TreeIndex
{
    private array $children;

    /**
     * Initiates substructure (array) for a given key
     *
     * @param $id
     */
    private function ensureKey($id) {
        if (!isset($this->children[$id])) {
            $this->children[$id] = [];
        }
    }

    /**
     * Adds a node to the tree
     *
     * @param int $id node ID
     * @param int $parentId parent node ID
     */
    public function addNode(int $id, int $parentId) {
        $this->ensureKey($parentId);
        $this->children[$parentId][] = $id;

        $this->ensureKey($id);
    }

    /**
     * Calculates all the children (the whole subtree) of a given node
     *
     * @param int $id given node ID
     * @return array subtree in the flat form
     * @throws Exception
     */
    public function findChildrenNodes(int $id): array {
        $result = [];

        if (!isset($this->children[$id])) {
            throw new Exception("Unknown ID: $id");
        }

        foreach ($this->children[$id] as $childId) {
            $result[] = $childId;
            $result = array_merge($result, $this->findChildrenNodes($childId));
        }

        return $result;
    }
}