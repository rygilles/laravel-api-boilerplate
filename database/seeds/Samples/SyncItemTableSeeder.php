<?php

use App\Models\SyncItem;
use Illuminate\Database\Seeder;

class SyncItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // John Smith Sample Project 1 sync items
        
        SyncItem::create([
            'item_id'           => 'a37eda90-1f56-11e7-93ae-92361f002671',
            'project_id'        => '1bcc7efc-138c-11e7-93ae-92361f002671',
            'item_signature'    => md5('a37eda90-1f56-11e7-93ae-92361f002671'),
        ]);

	    SyncItem::create([
		    'item_id'           => 'b06e221a-1f56-11e7-93ae-92361f002671',
		    'project_id'        => '1bcc7efc-138c-11e7-93ae-92361f002671',
		    'item_signature'    => md5('b06e221a-1f56-11e7-93ae-92361f002671'),
	    ]);

	    SyncItem::create([
		    'item_id'           => 'c07d179c-1f56-11e7-93ae-92361f002671',
		    'project_id'        => '1bcc7efc-138c-11e7-93ae-92361f002671',
		    'item_signature'    => md5('c07d179c-1f56-11e7-93ae-92361f002671'),
	    ]);

	    SyncItem::create([
		    'item_id'           => 'd1040d28-1f56-11e7-93ae-92361f002671',
		    'project_id'        => '1bcc7efc-138c-11e7-93ae-92361f002671',
		    'item_signature'    => md5('d1040d28-1f56-11e7-93ae-92361f002671'),
	    ]);

	    SyncItem::create([
		    'item_id'           => 'e6b018e2-1f56-11e7-93ae-92361f002671',
		    'project_id'        => '1bcc7efc-138c-11e7-93ae-92361f002671',
		    'item_signature'    => md5('e6b018e2-1f56-11e7-93ae-92361f002671'),
	    ]);
    }
}
