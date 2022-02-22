<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'collections';

    protected $guarded = ['id'];

    public function cards()
    {
        return $this->belongsToMany('App\Models\Card', 'card_collections');
    }
}
