<?php

namespace App\Imports;

use App\Models\TestCase;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TestCaseImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
//    public function model(array $row)
//    {
//        dd($row);
//        return new TestCase([
//            //
//        ]);
//    }
    
    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport(),
        ];
    }
}
