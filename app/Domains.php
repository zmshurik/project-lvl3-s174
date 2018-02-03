<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    protected $fillable = array('name', 'page_body', 'response_code', 'content_length', 'meta_keywords', 'main_header');
    /**
     * The table associated with the model.
     *
     * @var string
     */
}
