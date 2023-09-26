<?php

declare(strict_types=1);

namespace Freento\AuditDatabase\Model;

use Freento\AuditDatabase\Api\Data\TableInterface;
use Magento\Framework\DataObject;

class Table extends DataObject implements TableInterface
{
    /**
     * The table, which size exceeds this threshold (in kilobytes) should be marked in the report
     */
    private const SIZE_THRESHOLD = 200 * 1024;

    /**
     * Checks if table size exceeds threshold
     *
     * @return bool
     */
    public function isSizeOverThreshold(): bool
    {
        return $this->getSize() >= self::SIZE_THRESHOLD;
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->getData('name');
    }

    /**
     * @inheritDoc
     */
    public function getRows(): ?string
    {
        return $this->getData('rows');
    }

    /**
     * @inheritDoc
     */
    public function getEngine(): ?string
    {
        return $this->getData('engine');
    }

    /**
     * @inheritDoc
     */
    public function getCollation(): ?string
    {
        return $this->getData('collation');
    }

    /**
     * @inheritDoc
     */
    public function getSize(): ?int
    {
        return (int)$this->getData('size');
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): void
    {
        $this->setData('name', $name);
    }

    /**
     * @inheritDoc
     */
    public function setRows(string $rows): void
    {
        $this->setData('rows', $rows);
    }

    /**
     * @inheritDoc
     */
    public function setEngine(string $engine): void
    {
        $this->setData('engine', $engine);
    }

    /**
     * @inheritDoc
     */
    public function setCollation(string $collation): void
    {
        $this->setData('collation', $collation);
    }

    /**
     * @inheritDoc
     */
    public function setSize(string $size): void
    {
        $this->setData('size', $size);
    }
}
