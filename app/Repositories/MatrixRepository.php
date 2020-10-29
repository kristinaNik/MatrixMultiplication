<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 10/16/19
 * Time: 10:28 AM
 */

namespace App\Repositories;

use App\Interfaces\iMatrix;
use App\MatrixDimension;

class MatrixRepository implements iMatrix
{

    /**
     * @param $matrix
     * @return MatrixDimension|\Illuminate\Http\JsonResponse
     */
    public function set($matrix)
    {

        if ($matrix[0]['row'] != $matrix[1]['column']) {
            return response()->json(['fail' => 'The column count of the first matrix
                                            does not equal the row count in the second'],
                400);

        } else {
            foreach ($matrix as $key => $m) {

                $matrixDimension = new MatrixDimension();
                $matrixDimension->matrix_name = $m['name'];
                $matrixDimension->row = $m['row'];
                $matrixDimension->column = $m['column'];
                $matrixDimension->numbers = json_encode($m['numbers']);
                $matrixDimension->save();
            }
            return $matrixDimension;
        }
    }

    /**
     * @param $id
     * @param $name
     * @param $row
     * @param $columns
     * @param $numbers
     * @return mixed
     */
    public function update($id, $name,$row, $columns, $numbers)
    {
        $matrixDimension = MatrixDimension::findOrFail($id);

        $matrixDimension->matrix_name = $name;
        $matrixDimension->row = $row;
        $matrixDimension->column = $columns;
        $matrixDimension->numbers = json_encode($numbers);
        $matrixDimension->save();

        return $matrixDimension;
    }

    /**
     * @param $m1
     * @param $m2
     * @param $mat1
     * @param $n1
     * @param $n2
     * @param $mat2
     * @return void
     */
    public function multiply($m1, $m2, $mat1,
                             $n1, $n2, $mat2,
                             $name1, $name2)
    {
        echo $name1 . "*" . $name2 . PHP_EOL;
        for ($i = 0; $i < $m1; $i++)
        {
            for ($j = 0; $j < $n2; $j++)
            {
                $res[$i][$j] = 0;
                for ($k = 0; $k < $m2; $k++)
                    $res[$i][$j] += $mat1[$i][$k] *
                        $mat2[$k][$j];

                echo ($res[$i][$j]) . " ";

            }
            echo PHP_EOL;
        }


    }

}
