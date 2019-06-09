<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Arm extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'arms';

        public $primaryKey = 'id';

        

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function users()
        {
            return $this->hasMany('User');
        }

        public function fees()
        {
            return $this->hasMany('Fee');
        }


    }


?>
