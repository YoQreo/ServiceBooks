<?php
namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponser{
    /**
     * Build a success Response
     * @param string/array $data 
     * @param int $code 
     * @param string $type 
     * @return  Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK, $type){

        return response()->json(['data' => $data,'code' => $code, 'type' => $type],$code);

    }
    /**
     * Build a success Response
     * @param string  $message 
     * @param int $code 
     * @param string $type 
     * @return  Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code, $type = null){

        return response()->json(['error' => $message, 'code' => $code, 'type' => $type], $code);

    }

} 