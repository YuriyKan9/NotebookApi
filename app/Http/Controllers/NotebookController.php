<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class NotebookController extends Controller
{
    // private $id;

    // public function __construct(Notebook $notebook){
    //     $this->id = $notebook->id;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('notebooks')->paginate(1);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate(
            [
                'ФИО'=>'required',
                'Компания'=>'required',
                'Телефон'=>'required',
                'Email'=>'required|email',
                'Дата_рождения'=>'required',
            
            ]
        );

        if($request->hasFile('Фото')){
            $formFields['Фото'] = $request->file('Фото')->store('images','public');
        }
        return Notebook::create($formFields);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Notebook::find($id);
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
        $notebook = Notebook::find($id);
        // $notebook->update($request->all());
        // return $notebook;
        $formFields = $request->validate([
            'ФИО'=>'nullable',
            'Компания'=>'nullable',
            'Телефон'=>'nullable',
            'Email'=>'nullable|email|unique:notebooks,email,'.$notebook->id,
            'Дата_рождения'=>'nullable',
        ]);
        if($request->hasFile('Фото')){
            $formFields['Фото'] = $request->file('Фото')->store('images','public');
        }
        $notebook->update($formFields);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notebook $notebook)
    {
        $notebook->delete();
        return response('Note was deleted successfully!');
    }
}