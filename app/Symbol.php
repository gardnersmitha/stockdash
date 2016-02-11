<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
	/**
	 * The attributes that are mass assignable
	 * 
	 * @var array
	 *
	 */
	protected $fillable = ['symbol','symbol_id'];


	/**
	 *  
	 * Get all instances of a symbol
	 *
	 */
	public function instances()
	{
		return $this->hasMany(Instance::class);
	}

	public function reminders()
	{
		return $this->hasMany(Reminder::class);
	}
}