<?php

namespace App\Imports;
use Illuminate\Support\Collection;

class FourthSheetImport extends SecondSheetImport
{

	 /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
    	info('Fourth sheet importing...');
    	parent::collection($rows);
    }
}