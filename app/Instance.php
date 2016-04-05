<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    	/**
	 * The attributes that are mass assignable
	 * 
	 * @var array
	 *
	 */
	protected $fillable = ['symbol_id','source_type','source_name','action','sentiment','note','chart_url'];


	/**
	 *  
	 * Get all instances of a symbol
	 *
	 */
	public function symbol()
	{
		return $this->belongsTo(Symbol::class);
	}
	
	/**
	 *  
	 * Get all instances of a symbol
	 *
	 */
	public function reminder()
	{
		return $this->hasOne(Reminder::class);
	}
}



