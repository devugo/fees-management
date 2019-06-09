<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class Admin extends Eloquent 
{
	private $data;
    protected $guarded = [];

	protected $table = 'admins';

	public $primaryKey = 'id';

	public static $school_rules = [

        'name'=> [
            'required' => true,
            'min' => 3,
            'max' => 200
        ],
        'email' => [
            'required' => true,
            'min' => 3,
            'max' => 100,
            'unique' => 'School'
        ],
        'phone' => [
            'required' => true,
            'numeric' => true,
            'min' => 10,
            'max' => 10
        ],
        'city' => [
            'required' => true,
            'min' => 2,
            'max' => 50
        ],
        'address' => [
            'required' => true,
            'min' => 6,
            'max' => 200
        ],
        'state' => [
            'required' => true,
            'min' => 2,
            'max' => 50
        ]    

    ];

    public static $notification_rules = [
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

    public static $subscription_plan_rules = [
        'name' => [
            'required' => true,
            'min' => 1,
            'max' => 20
        ],
        'amount' => [
            'required' => true,
            'min' => 1,
            'max' => 50,
            'numeric' => true
        ],
        'sms' => [
            'required' => true,
            'min' => 1,
            'max' => 50,
            'numeric' => true
        ],
        'email' => [
            'required' => true,
            'min' => 1,
            'max' => 50,
            'numeric' => true
        ]
    ];

    public static $paystack_rules = [
        'public_key' => [
            'required' => true,
            'min' => 5,
            'max' => 30
        ],
        'secret_key' => [
            'required' => true,
            'min' => 5,
            'max' => 30
        ]
    ];

    public static $sms_rules = [
        'api_link' => [
            'required' => true,
            'min' => 5,
            'max' => 30
        ],
        'api_username' => [
            'required' => true,
            'min' => 5,
            'max' => 30
        ],
        'api_password' => [
            'required' => true,
            'min' => 5,
            'max' => 30
        ],
        'sender' => [
            'required' => true,
            'min' => 5,
            'max' => 30
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

    public function login($username, $password, $remember)
    {
        $admin = self::where('username', $username)->first();
        if($admin){
            $this->data = $admin;
            if(password_verify($password, $this->data()->password)){
                Session::put(Config::get('session/admin'), $this->data()->id);

                if($remember){
                    $hash = Hash::unique();
                    $hashExists = AdminSession::where('admin_id', $this->data()->id)->first();
                    if($hashExists){
                        $hash = $hashExists->hash;
                    }else{
                        AdminSession::create(
                            [
                                'admin_id' => $this->data()->id,
                                'hash' => $hash
                            ]
                        );
                    }

                    Cookie::put(Config::get('remember/admin'), $hash, Config::get('remember/expiry'));
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

    public static function confirm_proof_of_payment($val)
    {
        if($val->confirmed_at === NULL){
            //return 2; die();
            return '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Confirm Payment Proof" style="color: green; cursor: pointer;" onclick="confirmPayment(' . $val->id . ')" class="fa fa-plus-circle"></i>';
        }else{
            return '';
        }
    }

    public static function viewed_notification($val)
    {
        if($val->viewed_on != NULL){
            return '<span class="label label-success">viewed</span>';
        }else{
            return '<span class="label label-primary">Not viewed</span>';
        }
    }

    public static function active($val)
    {
        if($val->blocked_on === NULL){
            return '<span class="label label-success">Active</span>';
        }else{
            return '<span class="label label-danger">Deactivated</span>';
        }
    }

    public static function activateSubPlan($val)
    {
        if($val->blocked_on != NULL){
            //return 2; die();
            return '<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate Subscription Plan" href="/admin-manager/activate-subscription-plan/' . $val->id . '"><i style="color: green;" class="fa fa-plus-circle"></i></a>';
        }else{
            return '<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate Subscription plan" href="/admin-manager/deactivate-subscription-plan/' . $val->id . '"><i style="color: grey;" class="fa fa-ban"></i></a>';
        }
    }

    public static function replyTicket($val)
    {
        if($val->confirmed_at === NULL){
            return '<a href="/admin/reply-ticket/' . $val->id . '"><i style="color: green;" class="fa fa-reply"></i></a>';
        }else{
            return '';
        }
    }

    public function admin_sessions()
    {
        return $this->hasOne('AdminSession');
    }

}


?>
