<?php

declare(strict_types=1);

namespace Freento\AuditDatabase\Api;

use Freento\AuditDatabase\Api\Data\TableInterface;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\RuntimeException;

interface TableRepositoryInterface
{
    /**
     * Returns list of tables. table size is rounded off to the kilobytes
     *
     * @param  string $sortBy
     * @param  string $order
     * @return TableInterface[]
     * @throws FileSystemException
     * @throws RuntimeException
     */
    public function getList(string $sortBy, string $order): array;
}
