<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumCategoriesTableSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
		$categories = [];

		for ( $i = 1; $i <= 1; $i ++ ) {
			$cName = 'Проект #' . $i;

			$categories[] = [
				'title'	=>	$cName,
				'slug' 	=>	'builders',
			];
		}

		DB::table( 'forum_categories' )->insert( $categories );
	}
}
