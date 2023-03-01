<?php

namespace App\Http\Controllers\Admin\Transport;

use App\Http\Controllers\Controller;
use App\Model\Transport\Route;
use App\Model\Transport\Transport;
use App\Model\Transport\Vehicle;
use App\Model\Transport\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
class RouteController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	 
        $routes  = Route::latest('created_at')->paginate(20);
        return view('admin.transport.route',compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$rules=[
    	'name' => 'required|max:30', 
            'description' => 'nullable|string', 
          
    	];

    	$validator = Validator::make($request->all(),$rules);
    	if ($validator->fails()) {
    	    $errors = $validator->errors()->all();
    	    $response=array();
    	    $response["status"]=0;
    	    $response["msg"]=$errors[0];
    	    return response()->json($response);// response as json
    	}
         else {
            $route = new Route(); 
            $route->name = $request->name;
            $route->description = $request->description; 
    
            $route->save();
             $response=['status'=>1,'msg'=>'Created Successfully'];
            return response()->json($response); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $Vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $Vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $Vehicle)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
        
            
            'name' => 'required|max:30|unique:fee_accounts', 
            'description' => 'max:100', 
              
        ]);
        if ($validator->fails()) {                    
             return response()->json(['errors'=>$validator->errors()->all(),'class'=>'error']); 

        } else {
           $route = new Route(); 
         $route->name = $request->name;
         $route->description = $request->description;  
         $route->save();
           return response()->json([$Vehicle,'class'=>'success','message'=>'Update Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Vehicle = Route::findOrFail(Crypt::decrypt($id));
        $Vehicle->delete();
        return  redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
    }


     
}