<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class FeeUser extends Eloquent 
{

    protected $guarded = [];

	protected $table = 'fee_user';

    public $primaryKey = 'id';

    public function confirmed_payment()
    {
        return ($this->confirmed_at != NULL) ? true : false;
    }

    public function confirmed()
    {
        if($this->confirmed_at === NULL){
            return '<span class="label label-danger">Pending</span>';
        }
        return '<span class="label label-success">confirmed</span>';
    }

    public function waved()
    {
        return ($this->waved_at != NULL) ? true : false ;
    }
    
    public function school()
    {
        return $this->belongsTo('School');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function fee()
    {
        return $this->belongsTo('Fee');
    }

    public function guardian()
    {
        return $this->belongsTo('Guardian');
    }
}

?>