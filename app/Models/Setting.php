<?php

namespace App\Models;

use Backpack\Settings\app\Models\Setting as CoreSetting

class Setting extends CoreSetting
{
    protected $fillable = ['value', 'user_id'];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
