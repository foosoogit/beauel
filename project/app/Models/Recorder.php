<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recorder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
		'id_recorder',
		'name_recorder',
		'location',
		'location_url',
		'memo',
	];
}
