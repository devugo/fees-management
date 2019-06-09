<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class AdminSession extends Eloquent 
{   
    protected $guarded = [];

	protected $table = 'admins_sessions';

    public $primaryKey = 'id';
    
    public function admin()
    {
        return $this->hasOne('Admin');
    }
}