<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%articles}}`.
 */
class m231022_104642_create_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB');

        // Add indexes
        $this->createIndex('idx-articles-created_by', '{{%articles}}', 'created_by');
        $this->createIndex('idx-articles-category_id', '{{%articles}}', 'category_id');
 
        // Add foreign keys
        $this->addForeignKey('fk-articles-created_by', '{{%articles}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-articles-category_id', '{{%articles}}', 'category_id', '{{%categories}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys
        $this->dropForeignKey('fk-articles-created_by', '{{%articles}}');
        $this->dropForeignKey('fk-articles-category_id', '{{%articles}}');

        // Drop indexes
        $this->dropIndex('idx-articles-created_by', '{{%articles}}');
        $this->dropIndex('idx-articles-category_id', '{{%articles}}');

        $this->dropTable('{{%articles}}');
    }
}
