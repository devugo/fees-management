<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Subscription extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'subscriptions';

        public $primaryKey = 'id';

        

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function subscription_type(){
            return $this->belongsTo('SubscriptionType');
        }

        public function confirmed()
        {
            return ($this->confirmed_at != NULL) ? true : false;
        }

    }


?>
