<?php

class CitiesController extends \BaseController {

    /**
     * Instantiate a new CitiesController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => ['post','put', 'remove']));
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['cities'] = $cities = City::getData();
		if(Request::ajax())
        {
            $data["links"] = $cities->links();
            $cities = View::make('core.cities.cities', $data)->render();
            return Response::json(array('html' => $cities));
        }
        return View::make('core.cities.index')->with($data);	
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$city = new City;
        return View::make('core.cities.form')->with(['city' => $city]);	
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax()) {
  			$data = Input::all();
		    $city = new City;
	      	
	      	if ($city->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$city->fill($data);	        				        			
	        		$city->save();
					DB::commit();
					return Response::json(array('success' => true, 'city' => $city));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $city->errors;
        	$errors = View::make('errors', $data)->render();
    		return Response::json(array('success' => false, 'errors' => $errors));
  		}
        App::abort(404);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$city = City::find($id);
		if(!$city instanceof City) {
			App::abort(404);	
		}
        return View::make('core.cities.show')->with('city', $city);	
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$city = City::find($id);
		if(!$city instanceof City) {
			App::abort(404);	
		}
        return View::make('core.cities.form')->with('city', $city);	
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Request::ajax()) {
			$city = City::find($id);
			if(!$city instanceof City) {
				App::abort(404);	
			}       
	        $data = Input::all();
	      	if ($city->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$city->fill($data);	        				        			
	        		$city->save();
					DB::commit();
					return Response::json(array('success' => true, 'city' => $city));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $city->errors;
        	$errors = View::make('errors', $data)->render();
    		return Response::json(array('success' => false, 'errors' => $errors));
		}
        App::abort(404);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
