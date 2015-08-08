<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Unit extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'units';
    protected $fillable = array(
        'property_id', 'name', 'bedrooms', 'bathrooms', 'footage', 'description', 'rent_amount');
    //protected $with = array('property');
    
    /**
    * Validation Rule
    */
    public static $rules = array();

  
    /**
     * One Unit belongs to one Property
     */
    public function property()
    {
        return $this->belongsTo("Property");
    }
}
