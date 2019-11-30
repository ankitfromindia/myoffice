<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class FirstSheetImport implements SkipsUnknownSheets
{
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
