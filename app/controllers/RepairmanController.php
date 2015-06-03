<?php

class RepairmanController extends \BaseController {

    /**
     * Instantiate a new RepairmanController instance.
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
		$permission = Repairman::getPermission();
        if(@$permission->consulta) {
			$data['repairers'] = $repairers = Repairman::getData();
			if(Request::ajax())
	        {
	            $data["links"] = $repairers->links();
	            $repairers = View::make('core.repairers.repairers', $data)->render();
	            return Response::json(array('html' => $repairers));
	        }

            $data['permission'] = $permission;
	        return View::make('core.repairers.index')->with($data);	
    	}else{
            return View::make('core.denied');   
        }
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$permission = Repairman::getPermission();
        if(@$permission->adiciona) {
			$repairman = new Repairman;
	        $cities = City::lists('nombre', 'codigo');

	        return View::make('core.repairers.form')->with(['repairman' => $repairman, 'cities' => $cities]);		
   		}else{
            return View::make('core.denied');   
        }
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
		    $repairman = new Repairman;
	      	
	      	if ($repairman->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$repairman->fill($data);	        				        			
	        		$repairman->save();
					DB::commit();
					return Response::json(array('success' => true, 'repairman' => $repairman));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $repairman->errors;
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
		$permission = Repairman::getPermission();
        if(@$permission->consulta) {
			$repairman = Repairman::find($id);
			if(!$repairman instanceof Repairman) {
				App::abort(404);	
			}

			$city = City::find($repairman->ciudad);
			if(!$city instanceof City) {
				App::abort(404);	
			}
	        return View::make('core.repairers.show')->with(['repairman' => $repairman, 'city' => $city, 'permission' => $permission]);
		}else{
            return View::make('core.denied');   
        }
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$permission = Repairman::getPermission();
        if(@$permission->modifica) {
			$repairman = Repairman::find($id);
			if(!$repairman instanceof Repairman) {
				App::abort(404);	
			}
	        $cities = City::lists('nombre', 'codigo');

	        return View::make('core.repairers.form')->with(['repairman' => $repairman, 'cities' => $cities]);		
    	}else{
            return View::make('core.denied');   
        }
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
			$repairman = Repairman::find($id);
			if(!$repairman instanceof Repairman) {
				App::abort(404);	
			}       
	        $data = Input::all();
	      	if ($repairman->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$repairman->fill($data);	        				        			
	        		$repairman->save();
					DB::commit();
					return Response::json(array('success' => true, 'repairman' => $repairman));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $repairman->errors;
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
