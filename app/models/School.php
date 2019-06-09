<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class School extends Eloquent 
{
    private $data;
    private $classe = array();
    private $grad_year = array();
    protected $guarded = [];

	protected $table = 'schools';

	public $primaryKey = 'id';

	public static $school_rules = [

        'name'=> [
            'required' => true,
            'min' => 3
        ],
        'email' => [
            'required' => true,
            'min' => 3,
            'unique' => 'School'
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
            'required' => true,
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
            'min' => 1,
            'max' => 50
        ],
        'age' => [
            'required' => true
        ],
        'sex' => [
            'required' => true,
            'min' => 1,
            'max' => 6
        ],
        'arm' => [
            'required' => true,
            'min' => 1,
            'max' => 50
        ]
    ];

    public static $class_rules = [
        'class' => [
            'required' => true,
            'min' => 2,
            'max' => 15
        ],
        'level' => [
            'required' => true,
            'numeric' => true,
            'min' => 1,
            'max' => 2,
            'unique' => 'Classes'
        ]
    ];

    public static $fee_rules = [
        'class' => [
            'required' => true,
            'min' => 1,
            'max' => 1
        ],
        'arm' => [
            'required' => true,
            'max' => 1,
            'min' => 1
        ],
        'term' => [
            'required' => true,
            'min' => 1,
            'max' => 1
        ],
        'title' => [
            'required' => true,
            'min' => 3,
            'max' => 50
        ]
    ];

    public static $ticket_rules = [
        'title' => [
            'required' => true,
            'min' => 3,
            'max' => 100
        ],
        'description' => [
            'required' => true,
            'min' => 5,
            'max' => 2000
        ]

    ];

    public static $broadcast_rules = [
        'title' => [
            'required' => true,
            'min' => 3,
            'max' => 100
        ],
        'description' => [
            'required' => true,
            'min' => 5,
            'max' => 2000
        ]
    ];

    public static $profile_rules = [
        'name'=> [
            'required' => true,
            'min' => 3,
            'max' => 200
        ],
        'address' => [
            'required' => true,
            'min' => 3,
            'max' => 100
        ],
        'city' => [
            'required' => true,
            'min' => 2,
            'max' => 30
        ],
        'state' => [
            'required' => true,
            'min' => 2,
            'max' => 50
        ],
        'phone' => [
            'required' => true,
            'min' => 13,
            'max' => 13,
            'numeric' => true
        ]
    ];

    public static $bank_rules = [
        'account_name' => [
            'required' => true,
            'min' => 5,
            'max' => 30
        ],
        'account_no' => [
            'required' => true,
            'min' => 10,
            'max' => 10
        ],
        'bank' => [
            'required' => true,
            'min' => 3,
            'max' => 30
        ]
    ];

    public static $expenses_rules = [
        'title' => [
            'required' => true,
            'min' => 5,
            'max' => 30
        ],
        'description' => [
            'required' => true,
            'min' => 10,
            'max' => 500
        ],
        'amount' => [
            'required' => true,
            'numeric' => true
        ],
        'receiver' => [
            'required' => true,
            'min' => 3,
            'max' => 30
        ],
        'phone' => [
            'required' => true,
            'numeric' => true,
            'min' => 10,
            'max' => 10
        ],
        'payment_method' => [
            'required' => true
        ],
        'term' => [
            'required' => true
        ]
    ];

    public function login($email, $password, $remember)
    {
        $school = self::where('email', $email)->first();
        if($school){
            $this->data = $school;
            if(password_verify($password, $this->data()->password)){
                Session::put(Config::get('session/school'), $this->data()->id);

                if($remember){
                    $hash = Hash::unique();
                    $hashExists = SchoolSession::where('school_id', $this->data()->id)->first();
                    if($hashExists){
                        $hash = $hashExists->hash;
                    }else{
                        SchoolSession::create(
                            [
                                'school_id' => $this->data()->id,
                                'hash' => $hash
                            ]
                        );
                    }

                    Cookie::put(Config::get('remember/school'), $hash, Config::get('remember/expiry'));
                } 
                return true;  
            }
        }
        return false;
    }


    public function data()
    {
        return $this->data;
    }

    public function users()
    {
        return $this->hasMany('User');
    }

    public function guardians()
    {
        return $this->hasMany('Guardian');
    }

    public function classes()
    {
        return $this->hasMany('Classe');
    }

    public function fees()
    {
        return $this->hasMany('Fee');
    }

    public function subscriptions()
    {
        return $this->hasMany('Subscription');
    }

    public function subscriptions_balance()
    {
        return $this->hasOne('SubscriptionBalance');
    }

    public function payments()
    {
        return $this->hasMany('Payment');
    }

    public function tickets()
    {
        return $this->hasMany('Ticket');
    }

    public function broadcasts()
    {
        return $this->hasMany('Broadcast');
    }

    public function notifications()
    {
        return $this->hasMany('Notification');
    }

    public function school_sessions()
    {
        return $this->hasOne('SechoolSession');
    }

    public function arms()
    {
        return $this->hasMany('Arm');
    }

    public function terms()
    {
        return $this->hasMany('Term');
    }

    public function classe()
    {
        return $this->classe;
    }

    public function grad_year()
    {
        return $this->grad_year;
    }

    public function school_settings()
    {
        return $this->hasOne('SchoolSetting');
    }

    public function income()
    {
        return $this->hasOne('Income');
    }

    public function expenses()
    {
        return $this->hasMany('Expense');
    }

    public function fee_users()
    {
        return $this->hasMany('FeeUser');
    }

    public function bonuses()
    {
        return $this->hasMany('Bonus');
    }

    public function prepared_fees()
    {
        return $this->hasMany('PreparedFee');
    }

    public function blocked()
    {
        return ($this->blocked_on != NULL) ? true : false;
    }

    public function class_get()
    {
        $classes = $this->classes->sortBy('level');

        foreach($classes as $class){
            
            array_push($this->classe, $class->class);
        }
        return $this->classe();
    }

    public function grad_year_get()
    {
        $classes = $this->classes->sortBy('level');

        $count = count($classes);
        if(date("m") < 8){
            $count--;
        }
        $date = date("Y");

        foreach($classes as $class){
            $yearAdd = ' + ' . $count . ' years'; //Additional year to get the graduation year
            $actual = date("Y", strtotime($date . $yearAdd));
            array_push($this->grad_year, $actual);
            $count--;
        }
        return $this->grad_year();
    }

    public static function get_session()
    {
        if(date("m") < 8){
            $yearAdd = ' - ' . '1' . ' years';
            return date("Y", strtotime(date("Y") . $yearAdd)) . '/' . date("Y");
        }else{
            $yearAdd = ' + ' . '1' . ' years';
            return date("Y") . '/' . date("Y", strtotime(date("Y") . $yearAdd));
        }
    }

    public static function currency_formatter($curr)
    {
        $curr = strval($curr); // Converts integer into string
        if((strlen($curr))/4 >= 1){
            $count = 0;
            $store = '';
            for($i=strlen($curr)-1; $i>=0; $i--){
                if($count == 3){
                    $store = $curr[$i] . ',' . $store;
                    $count = 1;
                    continue;
                }
                $store = $curr[$i] . $store;
                $count++;
            }
            return 'NGN ' . $store . '.' . '00';
        }
        return 'NGN ' . $curr . '.' . '00';
    }

}


?>
