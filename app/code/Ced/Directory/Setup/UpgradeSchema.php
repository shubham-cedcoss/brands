<?php
namespace Ced\Directory\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Zend_Db_Exception;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();
        if (version_compare($context->getVersion(), '1.0.8') < 0) {
            $tableName = $setup->getTable('employee');
            $connection->changeColumn(
                $setup->getTable("employee"),
                'status',
                'status',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'default' => 0
                ]
            );
            if ($connection->isTableExists($tableName) != true) {
                $table = $connection->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        10,
                        ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                    )
                    ->addColumn(
                        'name',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable'=>false,'default'=>'']
                    )
                    ->addColumn(
                        'joining_date',
                        Table::TYPE_DATE,
                        255,
                        ['nullable'=>true]
                    )
                    ->addColumn(
                        'country_name',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable'=>true]
                    )
                    ->addColumn(
                        'gender',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable'=>true]
                    )
                    ->addColumn(
                        'status',
                        Table::TYPE_INTEGER,
                        1,
                        ['nullable'=>true]
                    )
                ->setOption('charset', 'utf8');
                $connection->createTable($table);
            }
            $columns = [
                'joining_date' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                    'nullable' => true,
                    'comment' => 'joining_date',
                ],
                'country_name' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment' => 'country_name',
                ],
                'gender' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment' => 'gender',
                ],
                'status' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => true,
                    'comment' => 'status',
                ],
            ];
            foreach ($columns as $name => $definition) {
                $connection->addColumn($tableName, $name, $definition);
            }
        }
        if (version_compare($context->getVersion(), '1.1.0') < 0) {
            $tableName = $setup->getTable('portfolio_images');
            if ($connection->isTableExists($tableName) != true) {
                $table = $connection->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        10,
                        ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                    )
                    ->addColumn(
                        'title',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable'=>false,'default'=>'']
                    )
                    ->addColumn(
                        'image',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable'=>false,'default'=>'']
                    )
                    ->addColumn(
                        'status',
                        Table::TYPE_INTEGER,
                        1,
                        ['nullable'=>false, 'default' => 0]
                    )
                    ->setOption('charset', 'utf8');
                $connection->createTable($table);
            }
            $columns = [
                'store_id' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => false,
                    'comment' => 'store_id',
                ],
                'sort_order' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => false,
                    'comment' => 'sort_order',
                    'default' => 0
                ],
                'description' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment' => 'description',
                ]
            ];
            foreach ($columns as $name => $definition) {
                $connection->addColumn($tableName, $name, $definition);
            }
        }
        $setup->endSetup();
    }
}
