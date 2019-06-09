<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Notification extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'notifications';

        public $primaryKey = 'id';

         /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = [
            'created_at',
            'updated_at',
            'viewed_on'
        ];

        public function viewedOn()
        {
            return ($this->viewed_on != NULL) ? true : false;
        }

        public function school()
        {
            return $this->belongsTo('School');
        }

    }


?>
