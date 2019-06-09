<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class AdminIncome extends Eloquent 
{   
    protected $guarded = [];

	protected $table = 'admin_incomes';

    public $primaryKey = 'id';

}