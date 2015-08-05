<?php

/*
* Manage Clients for API endpoints
*/
class ClientController extends BaseController {
    
    /**
     * Create a new client.
     */
    public function create()
    {   
        $validator = Validator::make($data = Input::all(), Client::$rules);

        if ($validator->fails())
        {
            return Response::json(['status' => 400, $validator->messages()], 400);
        }
        
        Client::create($data);
        
        return Response::json(['status' => 200], 200);
    }
    
    /**
     * Retrieve all clients
     */
    public function index()
    {
        $clients = Client::all();
        return Response::json($clients->toArray());
    }
    
    /**
    * Retrieve client by current user
    */
    public function indexByUser($user_id)
    {
        $clients = Client::where('user_id', $user_id)->get();
        return Response::json($clients->toArray());
    }
    
    /**
    * Retrieve client details by id
    */
    public function show($client_id)
    {
        $client = Client::find($client_id);
        
        if (!$client)
        {
            return Response::json(
                ['status' => 400, 
                'message' => 'Client does not exist'],
                400
            );
        }
        
        return Response::json(
            ['status' => 200, 
            'client' => $client->toArray()],
            200
        );
    }
    
    /**
    * Update client details
    */
    public function update($client_id)
    {
        $validator = Validator::make($data = Input::all(), Client::$rules);

        if ($validator->fails())
        {
            return Response::json($validator->messages(), 400);
        }
        
        try
        {
            Client::find($client_id)->update(Input::all());
            return Response::json("success", 200);
        }
        catch (Exception $e)
        {
            return Response::json("failure", 400);
        }
    }
}  
?>
