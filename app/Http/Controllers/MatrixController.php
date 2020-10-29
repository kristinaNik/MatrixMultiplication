<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatrixResource;
use App\MatrixDimension;
use App\Repositories\MatrixRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
    /**
     * Set dimensions of matrices
     *
     * @param Request $request
     * @param MatrixRepository $matrixRepository
     * @return MatrixResource
     */
    public function setDimensions(Request $request, MatrixRepository $matrixRepository) :MatrixResource
    {

        $matrix = $request->input('Matrix');
        $matrixDimensions =  $matrixRepository->set($matrix);

        return new MatrixResource($matrixDimensions);

    }

    /**
     * Update matrices
     *
     * @param Request $request
     * @param $id
     * @param MatrixRepository $matrixRepository
     * @return MatrixResource
     */
    public function updateDimensions(Request $request, $id, MatrixRepository $matrixRepository) :MatrixResource
    {

        $name = $request->input('name');
        $row = $request->input('row');
        $column = $request->input('column');
        $numbers = $request->input(['numbers']);
        try {
            $matrixDimensions = $matrixRepository->update($id,$name,$row,$column, $numbers);

            return new MatrixResource($matrixDimensions);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }

    }


    /**
     * Multiply Matrices
     *
     * @param MatrixRepository $matrixRepository
     * @return JsonResponse
     */
    public function multiplyMatrices(MatrixRepository $matrixRepository) :JsonResponse
    {
        $matrixDimensions = MatrixDimension::all();
        if ($matrixDimensions->isEmpty()) {
            return response()->json(['fail' => ['There are no available matrices']],404);
        }
        $numbers = $matrixDimensions->pluck('numbers')->toArray();
        $name = $matrixDimensions->pluck('matrix_name')->toArray();
        $matrix1 = json_decode($numbers[0]);
        $matrix2 = json_decode($numbers[1]);
        $countMatrix1   = count($matrix1);
        $countMatrix2   = count($matrix2);

        $matrixRepository->multiply($countMatrix1, $countMatrix2,
                $matrix1, $countMatrix1,
                $countMatrix2,$matrix2,
                $name[0], $name[1]);
    }

}
