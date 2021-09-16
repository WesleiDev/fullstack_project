<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FavoredRequest extends FormRequest
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
        $dataRequest = $this->request->all();
        return $this->mountedRuleForms($dataRequest['bank']);
    }

    function messages()
    {
        return [
          'agency.regex'  => 'A agência não está no formado correto',
          'agency.max'    => 'O tamanho máximo da agência deve ser de :max caracteres',
          'agency.required'    => 'A agência deve ser informada',
          'account.regex' => 'O número da conta não está no formado correto',
          'agencyDigit.regex' => 'O formato do dígito da agência não está no formato correto',
          'accountType.in' => 'Não é permitido esse tipo de conta para o banco informado'
        ];
    }

    //Cria a regra de validação para criar um associado
    function mountedRuleForms($codeBank){

        switch ($codeBank){
            case '001':
                //BANCO DO BRASIL
                return [
                    'agency'       =>  'regex:/^(?:^0*)[1-9][0-9]{0,3}$/|max:4|required',
                    'agencyDigit'  => 'regex:/^[xX0-9]{0,1}$/',
                    'account'      => 'regex:/^(?:^0*)[1-9][0-9]{0,7}$/|max:8|required',
                    'accountDigit' => 'regex:/^[xX0-9]{0,1}$/|required',
                    'accountType'  => [
                                        'required',
                                         Rule::in(['CONTA_CORRENTE', 'CONTA_POUPANCA', 'CONTA_FACIL'])
                                      ]
                ] ;
                break;
            default:
                //OUTROS BANCOS
                return [
                    'agency'       =>  'regex:/^(?:^0*)[1-9][0-9]{0,3}$/|max:4|required',
                    'agencyDigit'  => 'regex:/^[xX0-9]{0,1}$/',
                    'account'      => 'regex:/^(?:^0*)[1-9][0-9]{0,10}$/|max:11|required',
                    'accountDigit' => 'regex:/^[0-9]{0,1}$/|required',
                    'accountType'  => [
                        'required',
                        Rule::in(['CONTA_CORRENTE', 'CONTA_POUPANCA'])
                    ]
                ] ;
                break;
        }
    }


    protected function failedValidation(Validator $validator)
    {
        $response = new Response(['erro' => true, 'data' => $validator->errors()], 422);
        throw new ValidationException($validator, $response);
    }
}
