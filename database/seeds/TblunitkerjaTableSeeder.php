<?php

use Illuminate\Database\Seeder;

class TblunitkerjaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblunitkerja')->delete();
        
        \DB::table('tblunitkerja')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama_uk' => 'Unit Kerja A',
                'jml_formasi' => 1,
                'jml_existing' => 1,
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 05:21:21',
                'updated_at' => '2019-06-01 05:21:21',
            ),
        ));
        
        
    }
}