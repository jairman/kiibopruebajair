<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\TareaResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarea;



class TareaController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/tareas",
     *     tags={"Tareas"},
     *     summary="Ver Tareas ",

     *     @OA\Response(
     *         response=200,
     *         description="Se ha encontrado la siguiente información'"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="No se encontró información."
     *     )
     * )
     */
    public function index()
    {
        $id_user = auth()->user()->id;
        $tareas  = Tarea::where('id_user', $id_user)->get();

        return $this->sendResponse(TareaResource::collection($tareas), 'Tareas retrieved successfully.');
    }



    /**

     * Registrar Tarea.

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/tareas",
     *     tags={"Tareas"},
     *     summary="Registrar Tarea ",
     *      description="se envia el nombre de la tarea",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"nombre"},
     *               @OA\Property(property="nombre", type="text"),
     *
     *            ),
     *        ),
     *    ),
     *
     *  @OA\Response(
     *         response=200,
     *         description="Tarea creada con exito"
     *     ),
     *  @OA\Response(
     *         response="default",
     *         description="No se pudo crear  la tarea."
     *     )
     * )
     */
    public function store(Request $request)
    {
        $id_user = auth()->user()->id;
        $input   = ($request->all() + ['id_user' => $id_user]);

        $validator = Validator::make($input, [
            'nombre' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $tarea = Tarea::create($input);

        return $this->sendResponse(new TareaResource($tarea), 'Tarea created successfully.');
    }




    /**

     * Ver Tarea
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/tareas/{id}",
     *     tags={"Tareas"},
     *     summary="Ver Tarea ",
     *    description="se envia el id de la tarea",
     *   @OA\Parameter(
     *         description="Parámetro necesario (Id de Tarea)",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="5", summary="Introduce un número de id de la tarea.")
     *     ),
     *
     *  @OA\Response(
     *         response=200,
     *            description="Se ha encontrado la siguiente información'"
     *     ),
     *  @OA\Response(
     *         response="default",
     *           description="No se encontró información."
     *     )
     * )
     */


    public function show($id)
    {
        $tarea = Tarea::find($id);

        if (is_null($tarea)) {
            return $this->sendError('Tarea not found.');
        }

        return $this->sendResponse(new TareaResource($tarea), 'Tarea retrieved successfully.');
    }


    /**

     * Editar Tarea.
     * @return \Illuminate\Http\Response
     *
     * @OA\Put(
     *      path="/api/tareas/{id}",
     *     tags={"Tareas"},
     *     summary="Editar Tarea ",
     *      description="",
     *    @OA\Parameter(
     *         description="Parámetro necesario (Id de Tarea)",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="5", summary="Introduce un número de id de la tarea.")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="nombre", type="text"),
     *            ),
     *        ),
     *    ),
     *
     *  @OA\Response(
     *         response=200,
     *         description="Se ha actualizado la información de la tarea seleccionado"
     *     ),
     *  @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error inesperado al editar los datos."
     *     )
     * )
     */



    public function update(Request $request, Tarea $tarea)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nombre' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $tarea->nombre = $input['nombre'];
        $tarea->save();

        return $this->sendResponse(new TareaResource($tarea), 'Tarea updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @OA\Delete(
     *      path="/api/tareas/{id}",
     *     tags={"Tareas"},
     *     summary="Eliminar Tarea ",
     *    description="",
     *   @OA\Parameter(
     *          description="Parámetro necesario (Id de Tarea)",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="5", summary="Introduce un número de id de la tarea.")
     *     ),
     *
     *  @OA\Response(
     *         response=200,
     *         description="Tarea eliminada con éxito"
     *     ),
     *  @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error inesperado ."
     *     )
     * )
     */








    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return $this->sendResponse([], 'Tarea deleted successfully.');
    }
}
