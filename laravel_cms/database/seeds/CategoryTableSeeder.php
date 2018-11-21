<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach(['中单','上路','下路伤人组','打野'] as $v){
			DB::table('categories')
				->insert([
					'title' => $v,
					'icon' => 'fa fa-bar-chart-o',
				]);
		}
    }
}
