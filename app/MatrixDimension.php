<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatrixDimension extends Model
{
    protected  $fillable = ['matrix_name', 'row', 'column', 'numbers'];
}
