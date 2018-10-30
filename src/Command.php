<?php

namespace RuLong\Area;

use Illuminate\Console\Command as LaravelCommand;

class Command extends LaravelCommand
{

    protected $signature = 'rulong:areas';

    protected $description = 'Install RuLong-Area';

    public function handle()
    {
        // 创建数据库结构
        $this->call('migrate');
        // 迁移数据
        $this->call('db:seed', [
            '--class' => 'RulongAreasTableSeeder',
        ]);
        $this->info('Database migrate success');
    }

}
