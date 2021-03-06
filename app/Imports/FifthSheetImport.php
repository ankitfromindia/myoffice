<?php

namespace App\Imports;
use Illuminate\Support\Collection;

class FifthSheetImport extends SecondSheetImport
{

	 /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
    	info('fifth sheet importing...');
    	parent::collection($rows);
    }
}