<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory ;
    use Searchable;

	protected $fillable = ['name', 'description', 'imageUrl', 'date'];

    public function toSearchableArray()
    {
        $myarray = [
            'name'=>$this->name,
            'description'=>$this->description ,
        ] ;
        return $myarray ;
    }
}
