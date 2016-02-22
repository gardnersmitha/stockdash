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
	protected $fillable = ['symbol','symbol_id','is_muted'];

	/**
	 * A flag for whether or not the symbol is currently muted
	 * 
	 * @var boolean
	 *
	 */
	protected $isMuted = false;


	/**
	 *  
	 * Get all instances of a symbol
	 *
	 */
	public function instances()
	{
		return $this->hasMany(Instance::class);
	}

	/**
	 *  
	 * Get all reminders for a symbol
	 *
	 */
	public function reminders()
	{
		return $this->hasMany(Reminder::class);
	}

}