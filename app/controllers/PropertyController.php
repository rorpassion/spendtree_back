<?php

use Aws\S3\S3Client;
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
            if (Input::hasFile('photo') && Input::file('photo')->isValid())
            {
                // Upload file to AWS S3 bucket
                $s3 = AWS::get('s3');
                $photo_uploaded = $s3->putObject(array(
                    'Bucket'     => 'spendtree',
                    'Key'        => '',
                    'Body'       => Input::file('photo')
                ));
                $data['photo'] = $photo_uploaded['ObjectURL'];
            }
            
            if (Input::hasFile('doc') && Input::file('doc')->isValid())
            {
                // Upload file to AWS S3 bucket
                $s3 = AWS::get('s3');
                $doc_uploaded = $s3->putObject(array(
                    'Bucket'     => 'spendtree',
                    'Key'        => '',
                    'Body'       => Input::file('doc')
                ));
                $data['doc'] = $doc_uploaded['ObjectURL'];
            }
            
            $property = Property::create($data);
            $properties = Property::where('user_id', $user_id)->get();
        }
        catch (Exception $e)
        {
            return Response::json("failure", 400);   
        }
        return Response::json(['property' => $property->toArray(), 'properties' => $properties->toArray()], 200);
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
