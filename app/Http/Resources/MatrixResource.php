<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatrixResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Matrix name' => $this->matrix_name,
            'Matrix row' => $this->row,
            'Matrix column' => $this->column,
            'Matrix numbers' => $this->numbers
        ];
    }
}
