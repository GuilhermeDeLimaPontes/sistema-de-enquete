<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
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
            'title'=>['required','max:255'],
            'answers'=>['array','min:2','max:10','required'],
            'answers.*'=>['required']
        ];
    }

    public function messages()
    {
        return[
            'title.required'=>'Digite um titulo para enquete',
            'answers.required'=>'Digite uma resposta para a enquete',
            'answers.min'=>'Sua Enquete Deve Ter No Mínimo 2 respostas'
        ];
    }
}
