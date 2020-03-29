<?php

namespace App\Models;

use App\Models\Traits\{HasChildren, IsOrderable};
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasChildren, IsOrderable;

	protected $fillable = [
		'name',
		'order'
	];

	

    public function children()
    {
    	return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
