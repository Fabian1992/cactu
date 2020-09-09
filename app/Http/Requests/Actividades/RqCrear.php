<?php

namespace cactu\Http\Requests\Actividades;

use Illuminate\Foundation\Http\FormRequest;

class RqCrear extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'modelo'=>'required',
            'nombre'=>'required|string|max:191|unique:actividad,nombre,NULL,id,modeloProgramatico_id,' . $this->input('modelo'),
            'codigo'=>'required|string|max:191|unique:actividad,codigo,NULL,id,modeloProgramatico_id,' . $this->input('modelo')
        ];
    }
}
