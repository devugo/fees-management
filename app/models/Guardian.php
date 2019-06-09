<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Guardian extends Eloquent 
    {

        private $data; 
                            
        protected $guarded = [];

        protected $table = 'guardians';
        
        /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = [
            'created_at',
            'updated_at',
            'blocked_on'
        ];

        public $primaryKey = 'id';

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
                'unique' => 'Guardian'
            ],
            'phone' => [
                'required' => true,
                'numeric' => true,
                'min' => 10,
                'max' => 10
            ],
            'sex' => [
                'required' => true,
                'min' => 1,
                'max' => 6
            ]
        ];

        public static $student_rules = [
            'firstname' => [
                'required' => true,
                'min' => 2,
                'max' => 100
            ],
            'lastname' => [
                'required' => true,
                'min' => 2,
                'max' => 100
            ],
            'middlename' => [
                'required' => true,
                'min' => 2,
                'max' => 100
            ],
            'year_of_graduation' => [
                'reauired' => true,
                'numeric' => true,
                'min' => 4,
                'max' => 4
            ],
            'reg_no' => [
                'required' => true,
                'min' => 5,
                'max' => 50,
                'unique' => 'User'
            ],
            'guardian' => [
                'required' => true,
                'min' => 2,
                'max' => 100
            ],
            'age' => [
                'required' => true
            ],
            'sex' => [
                'required' => true,
                'min' => 1,
                'max' => 6
            ]
        ];

        public function login($email, $password, $remember)
        {
            $guardian = self::where('email', $email)->first();
            if($guardian){
                $this->data = $guardian;
                if(password_verify($password, $this->data()->password)){
                    Session::put(Config::get('session/guardian'), $this->data()->id);
    
                    if($remember){
                        $hash = Hash::unique();
                        $hashExists = GuardianSession::where('guardian_id', $this->data()->id)->first();
                        if($hashExists){
                            $hash = $hashExists->hash;
                        }else{
                            GuardianSession::create(
                                [
                                    'guardian_id' => $this->data()->id,
                                    'hash' => $hash
                                ]
                            );
                        }
    
                        Cookie::put(Config::get('remember/guardian'), $hash, Config::get('remember/expiry'));
                    } 
                    return true;  
                }
            }
            return false;
        }

        public static function viewed_notification($val)
        {
            if($val->viewed_on != NULL){
                return false;
            }else{
                return '<span class="label label-success">New</span>';
            }
        }

        public function data()
        {
            return $this->data;
        }

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function users()
        {
            return $this->hasMany('User');
        }

        public function broadcasts()
        {
            return $this->hasMany('Broadcast');
        }

        public function guardian_session()
        {
            return $this->hasOne('GuardianSession');
        }

        public function payments()
        {
            return $this->hasMany('Payment');
        }

        public function fee_users()
        {
            return $this->hasMany('FeeUser');
        }

        
    public function blocked()
    {
        return ($this->blocked_on != NULL) ? true : false;
    }

    }


?>
