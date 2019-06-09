<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Fee extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'fees';
        
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

        public function prepared()
        {
            return ($this->prepared != NULL) ? true : false;
        }
        
        public function send_noti()
        {
            return ($this->noti_sent != NULL) ? true : false;
        }

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function classe()
        {
            return $this->belongsTo('Classe');
        }

        public function arm()
        {
            return $this->belongsTo('Arm');
        }

        public function term()
        {
            return $this->belongsTo('Term');
        }

        public function users()
        {
            return $this->belongsToMany('User');
        }

        public function fee_users()
        {
            return $this->hasMany('FeeUser');
        }

        public function prepared_fees()
        {
            return $this->hasMany('PreparedFee');
        }

    }


?>
