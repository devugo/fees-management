<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class User extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'users';

        public $primaryKey = 'id';

        public static $school_owner_rules = [

            'name'=> [
                'required' => true,
                'min' => 3
                ],
            'email' => [
                'required' => true,
                'min' => 3
            ],
            'password' => [
                'required' => true,
                'min' => 7
            ],
            'confirm_password' => [
                'required' => true,
                'matches' => 'password'
            ]

        ];

        public static $guardian_rules = [
            'firstname' => [
                'required' => true,
                'min' => 2,
                'max' => 30
            ],
            'lastname' => [
                'required' => true,
                'min' => 2,
                'max' => 30
            ],
            'email' => [
                'required' => true,
                'min' => 6,
                'max' => 50,
                'unique' => 'User'
            ],
            'sex' => [
                'required' => true,
                'min' => 1,
                'max' => 6
            ]
        ];

        public function login_user($username, $password, $remeber)
        {

        }

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function guardian()
        {
            return $this->belongsTo('Guardian');
        }

        public function payments()
        {
            return $this->hasMany('Payment');
        }

        public function arm()
        {
            return $this->belongsTo('Arm');
        }

        public function fees()
        {
            return $this->belongsToMany('Fee');
        }

        public function fee_users()
        {
            return $this->hasMany('FeeUser');
        }

    }


?>
