<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    //public $timestamps = false;
    // protected $fillable = [
    //     'name',
    //     'created_by',
    //     'status',
    // ];

    static public function getRecord() {
        return self::select('categories.*', 'users.name as create_by_name')
        ->join('users', 'categories.created_by', '=', 'users.id')
        ->get();
    }
}
