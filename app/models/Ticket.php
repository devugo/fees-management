<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Ticket extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'tickets';

        public $primaryKey = 'id';

        

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function ticketsResponse()
        {
            return $this->hasOne('TicketsResponse');
        }

    }


?>
