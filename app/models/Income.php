<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Income extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'incomes';
        
        /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = [
            'created_at',
            'updated_at'
        ];

        public $primaryKey = 'id';

        public function school()
        {
            return $this->belongsTo('School');
        }


    }


?>
