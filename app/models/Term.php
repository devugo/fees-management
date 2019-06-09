<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Term extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'terms';

        public $primaryKey = 'id';

        

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function fees()
        {
            return $this->hasMany('Fee');
        }
        
    }


?>
