<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class PreparedFee extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'prepared_fees';

        public $primaryKey = 'id';

        

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function fee()
        {
            return $this->belongsTo('Fee');
        }

    }


?>
