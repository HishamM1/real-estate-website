<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];
    protected $appends = ['src'];

    public function listing()
    {

        return $this->belongsTo(Listing::class);
    }

    public function getSrcAttribute()
    {
        return asset('storage/' . $this->filename);
    }
}
