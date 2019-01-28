<?php

declare(strict_types=1);

namespace UserHierarchy\Services\Tree;

class LoopingThroughTreeAdaptor implements AdaptorInterface
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
        $this->tree = $this->createNewTree($this->collection, $parentId);
        return $this->tree;
    }

    private function createNewTree(array $elements, int $parentId)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['Parent'] == $parentId) {
                $children = $this->createNewTree($elements, $element['Id']);
                if ($children) {
                    $element['Children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function getTreeIds()
    {
        return $this->recursiveFindByKey($this->tree, 'Id');
    }

    private function recursiveFindByKey(array $array, $needle)
    {
        $iterator = new \RecursiveArrayIterator($array);
        $recursive = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);

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