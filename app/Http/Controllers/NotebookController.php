<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 * path="/api/v1/notebook",
 * summary="Show",
 * description="Show all notes",
 * tags={"Notebook"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="notebook", type="object", ref="#/components/schemas/Notebook"))
 *        )
 *     )
 * )
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
/**
 * @OA\Post(
 * path="/api/v1/notebook",
 * summary="Store New Note",
 * description="Create New Note",
 * tags={"Notebook"},
*      @OA\Parameter(
    * description="Information about yourself that you want to pass in ",
     *         in="path",
     *         name="Info",
     *         required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Notebook")
     *      ),
 * @OA\Response(
 *    response=201,
 *    description="Successful operation"
 *     ),
 * @OA\Response(
 *    response=422,
 *    description="Returns when you forget to pass required field or fields",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="The фио field is required"),
 *    )
 * )
 * )
 */
    public function store(Request $request)
    {
        $formFields = $request->validate(
            [
                'ФИО'=>'required',
                'Компания'=>'nullable',
                'Телефон'=>'required',
                'Email'=>'required|email|unique:notebooks,Email',
                'Дата_рождения'=>'nullable',
            
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
    
    /** @OA\Get(
        * path="/api/v1/notebook/{id}",
        * summary="Show note with id that you passed in",
        * description="Show note with id that you passed in",
        * tags={"Notebook"},
         *     @OA\Parameter(
     *         description="ID of note to show",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="notebook", type="object", ref="#/components/schemas/Notebook"))
        *        )
        *     )
        * )
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
    /**
 * @OA\Put(
 * path="/api/v1/notebook/{id}",
 * summary="Update Note",
 * description="Update Note",
 * tags={"Notebook"},
 *      @OA\Parameter(
     *         description="ID of note that you want to update",
     *         in="path",
     *         name="id",
     *         required=true,
     *     ),
 * @OA\Parameter(
    * description="Information that you want to update ",
     *         in="path",
     *         name="Information to update",
     *         required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Notebook")
     *      ),
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *   @OA\JsonContent(
*       @OA\Property(property="notebook", type="object", ref="#/components/schemas/Notebook"))
 *     ),
 * @OA\Response(
 *    response=500,
 *    description="Returns when note doesn't exist",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Internal server error"),
 *    )
 * )
 * )
 */
    public function update(Request $request, $id)
    {
        $notebook = Notebook::find($id);
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
        return $notebook;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
 * @OA\Delete(
 * path="/api/v1/notebook/{id}",
 * summary="Delete Note",
 * description="Delete Note",
 * tags={"Notebook"},
 *      @OA\Parameter(
     *         description="ID of note to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
 * @OA\Response(
 *    response=200,
 *    description="Note was deleted successfully!"
 *     ),
 * @OA\Response(
 *    response=404,
 *    description="Returns when note doesn't exist",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="No query results for model"),
 *    )
 * )
 * )
 */
    public function destroy(Notebook $notebook)
    {
        $notebook->delete();
        return response('Note was deleted successfully!');
    }
}