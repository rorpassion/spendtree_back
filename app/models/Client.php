<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Client extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';
    protected $fillable = array('user_id', 'name', 'email', 'phone', 'billing_address', 'mailing_address');
    
    /**
    * Validation Rule
    */
    public static $rules = array(
        'user_id'   => 'required',
        'name'      => 'required',
        'email'     => 'required'
    );

  
    /**
     * One User can have many clients
     */
    public function user()
    {
        return $this->belongsTo("User");
    }
    
    /**
    * One Client can have many properties
    * 
    */
    public function properties()
    {
        return $this->hasMany("Property");
    }
}
