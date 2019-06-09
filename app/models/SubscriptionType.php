<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class SubscriptionType extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'subscription_types';

        public $primaryKey = 'id';

        /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
            'blocked_on'
        ];


        public function subscriptions(){
            return $this->hasMany('Subscription');
        }

    }


?>
