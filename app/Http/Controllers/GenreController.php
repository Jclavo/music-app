<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//https://laravel.com/docs/5.7/validation

class GenreController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $genres = Genre::all();
                
        return $this->sendResponse($genres->toArray(), 'Genres retrieved successfully.');
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
        
        $input = $request->all();
        
        //Validations
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        
        /*$validator = $request->validate([
            //'title' => 'required|unique:posts|max:255',
            //'body' => 'required',
            'name' => 'required'
        ]);*/
        
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
       
        $genre = Genre::create($input);
        
        return $this->sendResponse($genre->toArray(), 'Genre created successfully.');   
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $genre = Genre::find($id);
        
        if (is_null($genre)) {
            return $this->sendError('Genre not found.');
        }
        
        return $this->sendResponse($genre->toArray(), 'Genre retrieved successfully.');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        
        $input = $request->all();
        
        //Validations
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        $genre = Genre::find($id);
        
        $genre->name = $request->name;
                
        $genre->save();
        
        
        return $this->sendResponse($genre->toArray(), 'Genre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $genre = Genre::find($id);
        
        $genre->delete();

        return $this->sendResponse($genre->toArray(), 'Genre deleted successfully.');
        
    }
}
