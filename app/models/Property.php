<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Property extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'properties';
    protected $fillable = array(
        'user_id', 'client_id', 'address', 'type', 'phone', 'total_units', 'reserve_amount', 'fee_type', 'fee_amount');
    protected $with = array('client');
    
    /**
    * Validation Rule
    */
    public static $rules = array(
        'user_id'   => 'required',
        'client_id' => 'required',
        'type'      => 'required'
    );

  
    /**
     * One Client belongs to one User
     */
    public function client()
    {
        return $this->belongsTo("Client");
    }
    
    /**
    * One Property can have many units
    */
    public function units()
    {
        return $this->hasMany("Unit");
    }
}
