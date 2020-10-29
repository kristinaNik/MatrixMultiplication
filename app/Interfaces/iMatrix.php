<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 10/17/19
 * Time: 11:14 AM
 */

namespace App\Interfaces;


interface iMatrix
{
    public function set($matrix);
    public function update($id, $name,$row, $columns, $numbers);
    public function multiply($m1, $m2, $mat1, $n1, $n2, $mat2, $name1, $name2);

}