<?php

declare(strict_types=1);

namespace Freento\AuditDatabase\Model;

use Freento\AuditDatabase\Api\TableRepositoryInterface;
use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\ResourceConnection;

class TableRepository implements TableRepositoryInterface
{
    /**
     * @var DeploymentConfig
     */
    private DeploymentConfig $deploymentConfig;

    /**
     * @var ResourceConnection
     */
    private ResourceConnection $resource;

    /**
     * @var TableFactory
     */
    private TableFactory $tableFactory;

    /**
     * @param DeploymentConfig $deploymentConfig
     * @param ResourceConnection $resource
     * @param TableFactory $tableFactory
     */
    public function __construct(
        DeploymentConfig $deploymentConfig,
        ResourceConnection $resource,
        TableFactory $tableFactory
    ) {
        $this->deploymentConfig = $deploymentConfig;
        $this->resource = $resource;
        $this->tableFactory = $tableFactory;
    }

    /**
     * @inheritdoc
     */
    public function getList($sortBy = 'size', $order = 'desc'): array
    {
        $db = $this->deploymentConfig->get('db/connection/default/dbname');
        $connection = $this->resource->getConnection();

        $orderSafe = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $select = $connection->select()
            ->from(
                'TABLES',
                [
                    'name' => 'TABLE_NAME',
                    'rows' => 'TABLE_ROWS',
                    'engine' => 'ENGINE',
                    'collation' => 'TABLE_COLLATION',
                    'size' => 'ROUND((DATA_LENGTH + INDEX_LENGTH) / 1024)'
                ],
                'information_schema'
            )
            ->where('TABLE_SCHEMA = :db')
            ->order([$sortBy . ' ' . $orderSafe]);

        $tablesInfo = $connection->fetchAll($select, ['db' => $db]);

        if (empty($tablesInfo)) {
            return [];
        }

        $tables = [];
        foreach ($tablesInfo as $record) {
            $table = $this->tableFactory->create();
            $table->setName($record['name'] ?? '');
            $table->setRows($record['rows'] ?? '');
            $table->setEngine($record['engine'] ?? '');
            $table->setCollation($record['collation'] ?? '');
            $table->setSize($record['size'] ?? '');
            $tables[] = $table;
        }

        return $tables;
    }
}
