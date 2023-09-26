<?php

declare(strict_types=1);

namespace Freento\AuditDatabase\Block\Adminhtml;

use Freento\AuditDatabase\Api\TableRepositoryInterface;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\RuntimeException;

class Report extends Template
{
    private const SIZE_UNIT = ' KB';
    public const THOUSANDS_SEPARATOR = ' ';
    public const MIN_SIZE_DISPLAYED = 0.01;

    /**
     * @var string
     */
    protected $_template = 'Freento_AuditDatabase::report.phtml';

    /**
     * @var TableRepositoryInterface
     */
    private TableRepositoryInterface $tableRepo;

    /**
     * @param Context $context
     * @param TableRepositoryInterface $tableRepo
     */
    public function __construct(Context $context, TableRepositoryInterface $tableRepo)
    {
        $this->tableRepo = $tableRepo;
        parent::__construct($context);
    }

    /**
     * Returns table list
     *
     * @return array
     * @throws FileSystemException
     * @throws RuntimeException
     */
    public function getTableList(): array
    {
        return $this->tableRepo->getList();
    }

    /**
     * Formats size
     *
     * @param float $size
     * @return string
     */
    public function formatSize(float $size): string
    {
        return ($size > self::MIN_SIZE_DISPLAYED
                ? number_format(
                    $size,
                    0,
                    null,
                    self::THOUSANDS_SEPARATOR
                )
                : number_format(
                    self::MIN_SIZE_DISPLAYED,
                    0,
                    null,
                    self::THOUSANDS_SEPARATOR
                )
            )
            . self::SIZE_UNIT;
    }
}
