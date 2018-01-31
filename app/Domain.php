<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = array('name');
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'domains';
}
