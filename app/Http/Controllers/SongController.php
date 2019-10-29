<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

// import the Intervention Image Manager Class
//use Intervention\Image\ImageManagerStatic as Image;

use App\Song;

class SongController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $song = Song::all();
        
        return $this->sendResponse($song->toArray(), 'Genres retrieved successfully.');
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
        //Validation        
        $input = $request->all();

        
        //Validations
        $validator = Validator::make($input, [
            'title' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        /*if($request->hasFile('song')) // validate file exist
        
        
        $extension = $song->getClientOriginalExtension(); // get extension
        $cover->getFilename() // get name
               
        */
        //$genre = Genre::create($input);
        
        //$fileMP3 = $request->song;
        $fileMP3 = $request->file('song');
               
        $song = Song::create([
            'title' => $request->title,
            'file' => $fileMP3,
            'genre_id' => 1
        ]);
        
        //MP3 Logic   
        $filename = Storage::disk('files')->put('/mp3', $fileMP3);
                
        $path = 'http://127.0.0.1:8000' . '/uploads/files/' . $filename ;

        // update path
        $song->file = $path;
        
        $song->save();
        
        return $this->sendResponse($song->toArray(), 'Song created successfully.');   
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
