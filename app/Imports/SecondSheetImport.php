<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\CsvData;

class SecondSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        info('second sheet importing...');
        $records = $rows->toArray();
       
        //dd($records);
        $headers = array_map(function($header){
            return ucwords(str_replace("_", " ", $header));
        }, array_keys(current($records)));
        
        $flatValues = [];
        array_push($flatValues, $headers);
        foreach($records as $record)
        {
            if(!empty(array_filter($record)))
            {
                array_push($flatValues, array_values($record));
            }
        }

        if(count($flatValues))
        {
            CsvData::create([
                'csv_filename' => request()->file('csv_file')->getClientOriginalName(),
                'csv_data' => mb_convert_encoding(json_encode($flatValues), 'UTF-8', 'auto')
            ]);
        }
        
    }
    
    public function headingRow(): int
    {
        return 4;
    }
}
