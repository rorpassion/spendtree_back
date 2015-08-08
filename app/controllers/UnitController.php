<?php

/*
* Manage Unit for API endpoints
*/
class UnitController extends BaseController {
    
    /**
     * Create a new unit
     */
    public function create()
    {   
        $validator = Validator::make($data = Input::all(), Unit::$rules);
        
        if ($validator->fails())
        {
            return Response::json($validator->messages(), 400);
        }
        
        try 
        {
            Unit::create($data);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return Response::json('failure', 400);   
        }
        return Response::json('success', 200);
    }
    
    /**
     * Retrieve units by property
     */
    public function index($property_id)
    {   
        $units = Unit::where('property_id', $property_id)->get();
        return Response::json($units->toArray(), 200);
    }
    
    
    /**
    * Retrieve Unit details by id
    */
    public function show($property_id, $id)
    {
        $unit = Unit::find($id);
        
        if (!$unit)
        {
            return Response::json('Unit does not exist', 400);
        }
        
        return Response::json(['unit' => $unit->toArray()], 200);
    }
    
    /**
    * Update Unit
    */
    public function update($id)
    {
        $validator = Validator::make($data = Input::all(), Unit::$rules);

        if ($validator->fails())
        {
            return Response::json($validator->messages(), 400);
        }
        
        try
        {
            $unit = Unit::find($id)->update(Input::all());
        }
        catch (Exception $e)
        {
            return Response::json("failure", 400);
        }
        
        return Response::json("success", 200);
    }
}  
?>
