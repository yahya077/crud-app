<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotePostRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();

        return response()->success("Notes are listed", NoteResource::collection($notes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NotePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotePostRequest $request)
    {
        $note = Note::create($request->all());

        return response(['success' => true, 'data'=> $note]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return response()->success('Selected note is showing', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $note->update($request->all());

        return response()->success('The note is updated', new NoteResource($note));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->success('The note is deleted', []);
    }
}
