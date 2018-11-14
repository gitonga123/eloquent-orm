<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use ElasticquentTrait;
    protected $fillable
}
