<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    //Attributes
    public function getImageAttribute($key)
    {
        if (is_null($key)) {
            return null;
        }

        return url('/').'/'.$key;
        //return url('/').$key;
    }

    //Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
