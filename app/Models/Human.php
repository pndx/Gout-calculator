<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Human
 *
 * @package App\Models
 * @property int id
 * @property string name
 * @property int age
 * @property string address
 * @property bool is_painful
 * @property int purine
 */
class Human extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'address', 'is_painful', 'purine'];
}
