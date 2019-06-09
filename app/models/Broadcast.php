<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Broadcast extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'broadcasts';

        public $primaryKey = 'id';

         /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = [
            'created_at',
            'updated_at'
        ];

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function guardian()
        {
            return $this->belongsTo('Guardian');
        }

    }


?>
