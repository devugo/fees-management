<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Bonus extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'bonuses';

        public $primaryKey = 'id';

        

        public function school()
        {
            return $this->belongsTo('School');
        }


    }


?>
