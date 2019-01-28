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
     * @return array
     */
    public function buildTree(int $parentId)
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

    public function getTreeIds()
    {
        return $this->getIds($this->tree);
    }

    private function getIds($tree)
    {
        return $this->recursiveFindByKey($tree, 'Id');
    }

    private function recursiveFindByKey(array $array, $needle)
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