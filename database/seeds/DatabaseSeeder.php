<?php

use App\Models\Good;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $this->call('GoodTableSeeder');

        $this->command->info('Таблица пользователей заполнена данными!');
	}

}

class GoodTableSeeder extends Seeder {

    public function run()
    {
        DB::table('goods')->delete();

        Good::create(array('title' => 'Товар_1', 'price' => 100));
        Good::create(array('title' => 'Товар_2', 'price' => 200));
        Good::create(array('title' => 'Товар_3', 'price' => 300));
        Good::create(array('title' => 'Товар_4', 'price' => 400));
        Good::create(array('title' => 'Товар_5', 'price' => 500));
        Good::create(array('title' => 'Товар_6', 'price' => 600));
        Good::create(array('title' => 'Товар_7', 'price' => 700));
        Good::create(array('title' => 'Товар_8', 'price' => 800));
        Good::create(array('title' => 'Товар_9', 'price' => 900));
        Good::create(array('title' => 'Товар_10', 'price' => 1000));
    }

}
