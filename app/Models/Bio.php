<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bio extends Model
{
    use HasFactory;



    public $incrementing = true;
    protected $keyType = 'string';


    protected $fillable = [
        "phone",
        "photo",
        "num_doc",
        "description",
        "formation",
        "area",
        "institute",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
