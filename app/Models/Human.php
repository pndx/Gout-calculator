<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property int age
 * @property string address
 * @property bool is_painful
 * @property int purine
 */
class Human extends Model
{
    use HasFactory;
}
