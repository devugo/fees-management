<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class TicketResponse extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'tickets_responses';

        public $primaryKey = 'id';

        

        public function ticket()
        {
            return $this->belongsTo('Ticket');
        }

    }


?>
