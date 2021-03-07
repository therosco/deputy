<?php

namespace Deputy\DataStructures;

use Exception;

/**
 * Class ManyToOne
 *
 * This is to encapsulate data with a primary Id and a related id.
 * Provides best possible access time
 *
 * @package Deputy\Utils
 */
class ManyToOneStorage
{
    private array $data = [];
    private array $indexMap = [];
    private array $reverseMap = [];

    /**
     * Adds data to the storage
     *
     * @param int $id unique key
     * @param int $related_id related key
     * @param $data some data to store
     * @throws Exception
     */
    public function add(int $id, int $related_id, $data) {
        if (isset($this->indexMap[$id])) {
            throw new Exception("Element with ID $id already registered");
        }

        $this->data[$id] = $data;
        $this->indexMap[$id] = $related_id;

        if (!isset($this->reverseMap[$related_id])) {
            $this->reverseMap[$related_id] = [];
        }

        $this->reverseMap[$related_id][] = $id;
    }

    /**
     * Returns data by it's primary key
     *
     * @param int $id the key
     * @return mixed|null data
     */
    public function getById(int $id) {
        return $this->indexMap[$id] ? $this->data[$id] : null;
    }

    /**
     * Returns data by it's related key
     *
     * @param int $related_id the related key
     * @return array data list
     */
    public function getByRelatedId(int $related_id): array {
        $result = [];
        foreach ($this->reverseMap[$related_id] as $id) {
            $result[] = $this->data[$id];
        }

        return $result;
    }
}