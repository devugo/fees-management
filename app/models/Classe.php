<?php


    use Illuminate\Database\Eloquent\Model as Eloquent;

    class Classe extends Eloquent 
    {
                            
        protected $guarded = [];

        protected $table = 'classes';

        public $primaryKey = 'id';

       /* public function delete()
        {
            // delete all related photos 
            $this->fees()->delete();
            //$this
            // as suggested by Dirk in comment,
            // it's an uglier alternative, but faster
            // Photo::where("user_id", $this->id)->delete()

            // delete the user
            return parent::delete();
        }*/

        public function school()
        {
            return $this->belongsTo('School');
        }

        public function fees()
        {
            return $this->hasMany('Fee');
        }

    }


?>
