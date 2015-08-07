<?php

/*
* Manage Property for API endpoints
*/
class PropertyController extends BaseController {
    
    /**
     * Create a new property
     */
    public function create($user_id)
    {   
        $validator = Validator::make($data = Input::all(), Property::$rules);
        
        if ($validator->fails())
        {
            return Response::json($validator->messages(), 400);
        }
        
        try 
        {
            $property = Property::create($data);
        }
        catch (Exception $e)
        {
            return Response::json("failure", 400);   
        }
        return Response::json($property->toArray(), 200);
    }
    
    /**
     * Retrieve properties by user
     */
    public function index($user_id)
    {   
        $properties = Property::where('user_id', $user_id)->get();
        return Response::json($properties->toArray(), 200);
    }
    
    
    /**
    * Retrieve client details by id
    */
    public function show($user_id, $id)
    {
        $property = Property::find($id);
        
        if (!$property)
        {
            return Response::json('Property does not exist', 400);
        }
        
        return Response::json(['property' => $property->toArray()], 200);
    }
    
    /**
    * Update client details
    */
    public function update($user_id, $id)
    {
        $validator = Validator::make($data = Input::all(), Property::$rules);

        if ($validator->fails())
        {
            return Response::json($validator->messages(), 400);
        }
        
        try
        {
            $property = Property::find($id)->update(Input::all());
            $properties = Property::where('user_id', $user_id)->get();
        }
        catch (Exception $e)
        {
            return Response::json("failure", 400);
        }
        
        return Response::json($properties->toArray(), 200);
    }
}  
?>
