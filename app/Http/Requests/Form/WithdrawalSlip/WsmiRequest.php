<?php

namespace App\Http\Requests\Form\WithdrawalSlip;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WsmiRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_name'         => 'required',
            'pallet_no'             => 'required',
            'warehouse'             => 'required',
            'wh_location'           => 'required',
            'profit_center'         => 'required',
            'sub_profit_center'     => 'required',
            'sales_order_number'    => 'required',
            'prepared_by'           => 'required',
            'approved_by'           => 'required',
            'released_by'           => 'required',
            'checked_by'            => 'required',
            'noted_by'              => 'required',
            'items.*'               => 'required'
        ];
    }

    /**
     * Return Error
     */

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'success'       => false,
            'errorInfo'     => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
