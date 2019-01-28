<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

interface RepositoryInterface
{
    public function getAll();

    public function save(array $item): bool;

    public function remove();

    public function update();
}