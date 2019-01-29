<?php

declare(strict_types=1);

namespace UserHierarchy\Services\Tree;

use BlueM\Tree;

class ExternalPackageAdaptor implements AdaptorInterface
{
    /** @var array $collection */
    private $collection;

    /** @var Tree $tree */
    private $tree = [];

    private $parentId = 0;

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
        $this->parentId = $parentId;

        $this->tree = new Tree($this->collection, ['id' => 'Id', 'parent' => 'Parent']);

        return $this;
    }

    public function getAllDescendantsIds(): array
    {
        $ids = [];

        $roleChildren = $this->tree->getNodeById($this->parentId);
        $childrenNodes = $roleChildren->getDescendants();

        foreach ($childrenNodes as $node) {
            $ids[] = $node->getId();
        }

        return $ids;
    }
}