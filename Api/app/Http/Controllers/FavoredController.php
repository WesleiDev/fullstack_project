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
    public function index(Request $request)
    {
        try{
            $search  = $request->get('search');
            $perpage = $request->get('perpage') ?? 10 ;
            $page    = $request->get('page') ?? 1;
//            dd($page);

            return FavoredResource::collection(
                Favored::where(function($query) use ($search){
                    $query->where('favoreds.name', 'LIKE', "%".$search."%" )
                          ->orWhere( 'favoreds.document', 'LIKE', "%".$search."%")
                          ->orWhere( 'favoreds.agency', 'LIKE', "%".$search."%")
                          ->orWhere( 'favoreds.account', 'LIKE', "%".$search."%");

                })->paginate($perpage, ['*'], 'page', $page)
            );
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
            $favored = Favored::create($data);
            return response()->json([
               'data' => $favored,
               'error' => false
            ]);

        }catch(\Exception $e){
            return response()
                ->json([
                    'data' => 'Erro ao salvar favorecido. Por favor tente novamente. '.$e->getMessage(),
                    'error' => true
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $favored = Favored::findOrFail($id);
            return response()->json([
                'data' => $favored,
                'error' => false
            ]);

        }catch(\Exception $e){
            return response()
                ->json([
                    'data' => 'Erro ao consultar favorecido. Por favor tente novamente. '.$e->getMessage(),
                    'error' => true
                ]);
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(FavoredRequest $request, $id)
    {
        try{
            $data = $request->all();
            $favored = Favored::findOrFail($id);
            $favored->update($data);

            return response()->json([
                'data' => $favored,
                'error' => false
            ]);

        }catch(\Exception $e){
            return response()
                ->json([
                    'data' => 'Erro ao salvar favorecido. Por favor tente novamente. '.$e->getMessage(),
                    'error' => true
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $favored = Favored::findOrFail($id);
            $favored->delete();

            return response()->json([
                'data' => 'Favorecido excluido com sucesso!',
                'error' => false
            ]);

        }catch(\Exception $e){
            return response()
                ->json([
                    'data' => 'Erro ao excluir favorecido. Por favor tente novamente. '.$e->getMessage(),
                    'error' => true
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function massDelete(Request $request)
    {
        try{
            $data = $request->all();

            foreach ($data['ids'] as $id){
                $favored = Favored::findOrFail($id);
                $favored->delete();

            }

            return response()->json([
                'data' => 'Favorecidos excluidos com sucesso!',
                'error' => false
            ]);

        }catch(\Exception $e){
            return response()
                ->json([
                    'data' => 'Erro ao excluir favorecido. Por favor tente novamente. '.$e->getMessage(),
                    'error' => true
                ]);
        }
    }
}
