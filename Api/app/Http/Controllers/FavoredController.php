<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoredRequest;
use App\Http\Resources\FavoredResource;
use App\Models\Favored;
use Illuminate\Http\Request;

class FavoredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        try{
            return FavoredResource::collection(Favored::paginate());
        }catch(\Exception $e){
            return response()
                ->json([
                    'data' => 'Erro ao consultar favorecidos. Tente novamente!',
                    'error' => true
                ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FavoredRequest $request)
    {
        try{
            $data = $request->all();

        }catch(\Exception $e){
            return response()
                ->json([
                    'data' => 'Erro ao salvar cliente. Por favor tente novamente. '.$e->getMessage(),
                    'error' => true
                ]);
        }
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
