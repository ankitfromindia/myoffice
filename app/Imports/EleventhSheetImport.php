<?php

namespace App\Imports;
use Illuminate\Support\Collection;

class EleventhSheetImport extends SecondSheetImport
{

	 /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
    	info('third sheet importing...');
    	parent::collection($rows);
    }
}