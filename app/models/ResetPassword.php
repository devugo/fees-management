<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class ResetPassword extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'password_resets';

        public $primaryKey = 'id';


    }


?>
