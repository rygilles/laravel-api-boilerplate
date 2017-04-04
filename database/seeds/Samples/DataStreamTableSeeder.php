<?php

use App\Models\DataStream;
use Illuminate\Database\Seeder;

class DataStreamTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// John Smith Sample Project 1
		DataStream::create([
			'id'        => '56278dc8-1934-11e7-93ae-92361f002671',
			'name'      => 'John Smith Sample Project Data Stream',
			'feed_url'  => 'http://domain.tld/feedJohn.json',
		]);

		// No data stream for John Smith Sample Project 2

		// Mickey Mouse Sample Project
		DataStream::create([
			'id'        => '605d712c-1934-11e7-93ae-92361f002671',
			'name'      => 'Mickey Mouse Sample Project Data Stream',
			'feed_url'  => 'http://domain.tld/feedTheMouse.json',
		]);
	}
}
