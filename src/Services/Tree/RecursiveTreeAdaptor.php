<?php

declare(strict_types=1);

namespace UserHierarchy\Services\Tree;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class RecursiveTreeAdaptor implements AdaptorInterface
{
    /** @var array $collection */
    private $collection;

    /** @var array $tree */
    private $tree = [];

    /**
     * RecursiveTreeAdaptor constructor.
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param int $parentId
     * @return AdaptorInterface
     */
    public function buildTree(int $parentId): AdaptorInterface
    {
        $this->createTree($parentId);

        return $this;
    }

    /**
     * @return array
     */
    public function getAllDescendantsIds(): array
    {
        return $this->recursiveFindByKey($this->tree, 'Id');
    }

    /**
     * @param $parentId
     * @return array
     */
    private function createTree($parentId): array
    {
        array_walk($this->collection, function ($item) use ($parentId) {
            if ($item['Parent'] === $parentId) {
                $item['Children'] = $this->buildTree($item['Id']);
                $this->tree[] = $item;
                unset($item);
            }
        });

        return $this->tree;
    }


    /**
     * @param array $array
     * @param string $needle
     * @return array
     */
    private function recursiveFindByKey(array $array, string $needle): array
    {
        $iterator = new RecursiveArrayIterator($array);
        $recursive = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);

        $list = [];

        foreach ($recursive as $key => $value) {
            if ($key !== $needle) {
                continue;
            }
            array_push($list, $value);
        }

        return $list;
    }
}