<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//TODO morph
class SectionComment extends Model
{
    use HasFactory;

    protected $table = 'sections_comments';
}
