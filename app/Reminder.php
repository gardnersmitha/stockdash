<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
	/**
	 * The attributes that are mass assignable
	 * 
	 * @var array
	 *
	 */
	protected $fillable = ['symbol_id','instance_id','remind_on'];


	/**
	 *  
	 * Get all instances of a symbol
	 *
	 */
	public function instance()
	{
		return $this->belongsTo(Instance::class);
	}

	/**
	 *  
	 * Get all instances of a symbol
	 *
	 */
	public function symbol()
	{
		return $this->belongsTo(Symbol::class);
	}
}
