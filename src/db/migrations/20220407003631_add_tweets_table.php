<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddTweetsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('tweets');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('tweet', 'string', ['limit' => 70])
            ->addColumn('reply_tweet_id', 'integer', ['null' => true])
            ->addColumn('device', 'text')
            ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            // TODO: ユーザー登録機能の実装ができたらこれを実行する
            // ->addForeignKey('user_id', 'users', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();
    }
}
