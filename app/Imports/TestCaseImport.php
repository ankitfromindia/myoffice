<?php

namespace App\Imports;

use App\Models\TestCase;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class TestCaseImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            new FirstSheetImport(),
            new SecondSheetImport(),
            new ThirdSheetImport(),
            new FourthSheetImport(),
            new FifthSheetImport(),
            new SixthSheetImport(),
            new SeventhSheetImport(),
            new EighthSheetImport(),
            new NinthSheetImport(),
            new TenthSheetImport(),
            new EleventhSheetImport(),
            new TwelfthSheetImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
