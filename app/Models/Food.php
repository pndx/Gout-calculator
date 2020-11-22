<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Food
 *
 * @package App\Models
 * @property string name
 * @property int purine
 */
class Food extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'purine'];
}
