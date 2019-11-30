<?php

namespace App\Models;

/**
 * CsvData
 * 
 * @author Ankit Vishwakarma <ankit.vishwakarma@vfirst.com>
 * @createdAt 28 Nov, 2019 2:51:04 PM 
 */
use Illuminate\Database\Eloquent\Model;
class CsvData extends Model
{
    protected $table = 'csv_data';
    protected $fillable = ['csv_filename', 'csv_data', 'created_by'];
}
