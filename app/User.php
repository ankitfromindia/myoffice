<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,CrudTrait,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function parent()
    {
        return $this->hasOne(\App\User::class, 'parent_id');
    }

    public function children()
    { 
        return $this->hasMany('App\User', 'parent_id', 'id');
    }


    public static function getAllChildren(int $userId)
    {
        $allChilds= self::where('id', $userId)->with('children.children.children.children')->first();
        $allChildIds=[];
        
        if (isset($allChilds->children) && !empty($allChilds->children)) {
            //user have any number of child on same hirarchi
            foreach ($allChilds->children as $keyL1 => $valueL1) {
                 array_push($allChildIds, $valueL1->id);
                if (isset($valueL1->children) && !empty($valueL1->children)) {
                    foreach ($valueL1->children as $key2 => $valueL2) {
                        array_push($allChildIds, $valueL2->id);
                        if (isset($valueL2->children) && !empty($valueL2->children)) {
                            foreach ($valueL2->children as $keyL3 => $valueL3) {
                                array_push($allChildIds, $valueL3->id);
                            }
                        }
                    }
                }
            }
        }
        
        return  $allChildIds;
    }
}
