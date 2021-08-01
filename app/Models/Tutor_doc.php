<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor_doc extends Model
{
    use HasFactory;
    protected $table = 'tutors_document';
    public $timestamps = false;
}
