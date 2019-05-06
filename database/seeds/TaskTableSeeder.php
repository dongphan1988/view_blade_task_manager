<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = new \App\Task();
        $task->id = 1;
        $task->title = 'demo';
        $task->content = 'task manager';
        $task->save();
    }
}
