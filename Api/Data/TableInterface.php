<?php

declare(strict_types=1);

namespace Freento\AuditDatabase\Api\Data;

interface TableInterface
{
    /**
     * Returns table name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Returns table rows
     *
     * @return string|null
     */
    public function getRows(): ?string;

    /**
     * Returns table engine
     *
     * @return string|null
     */
    public function getEngine(): ?string;

    /**
     * Returns table collation
     *
     * @return string|null
     */
    public function getCollation(): ?string;

    /**
     * Sets table size
     *
     * @return int|null
     */
    public function getSize(): ?int;

    /**
     * Sets table name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Sets table rows
     *
     * @param string $rows
     * @return void
     */
    public function setRows(string $rows): void;

    /**
     * Sets table engine
     *
     * @param string $engine
     * @return void
     */
    public function setEngine(string $engine): void;

    /**
     * Sets table collation
     *
     * @param string $collation
     * @return void
     */
    public function setCollation(string $collation): void;

    /**
     * Sets table size
     *
     * @param string $size
     * @return void
     */
    public function setSize(string $size): void;
}
