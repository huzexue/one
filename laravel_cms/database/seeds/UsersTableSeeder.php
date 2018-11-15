<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
	 * artisan migrate:refresh --seed //执行此命令可重建表结构，生成新数据
     * @return void
     */
    public function run()
    {
		//DB::table('users')->insert([
		//	'name' => str_random(10),
		//	'email' => str_random(10).'@gmail.com',
		//	'password' => bcrypt('secret'),
		//]);
		factory(App\User::class, 10)->create();
		$user = \App\User::find(1);
		$user->name = '后台总管';
		$user->email = '314330329@qq.com';
		$user->password = bcrypt('11111');
		$user->is_admin = 1;
		$user->save();
    }
}
