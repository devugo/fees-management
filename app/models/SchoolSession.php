<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class SchoolSession extends Eloquent 
{   
    protected $guarded = [];

	protected $table = 'schools_session';

	public $primaryKey = 'id';

	public function school()
	{
		return $this->hasOne('School');
	}
}