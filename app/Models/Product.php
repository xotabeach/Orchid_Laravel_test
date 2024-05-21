<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'price',
        
    ];


    public function getContent()
    {
        
        return "Name: " . $this->name . ", Price: " . $this->price;
    }
}
