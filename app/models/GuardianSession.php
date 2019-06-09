<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class GuardianSession extends Eloquent 
{   
    protected $guarded = [];

	protected $table = 'guardians_sessions';

    public $primaryKey = 'id';
    
    public function guardian()
    {
        return $this->hasOne('Guardian');
    }
}