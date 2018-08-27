<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\WeightLog;
use Auth;

class StoreWeightLog extends FormRequest
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
            'log_date'  => 'required|date_format:Y-m-d',
            'min'       => 'required|integer|min:0',
            'max'       => 'required|integer|gte:min'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            if ($this->checkLogDateExist(request()->input('log_date'))) {
                $validator->errors()->add('log_date', 'Log Date is already exist');
            }
        });
        
    }

    public function checkLogDateExist($logDate)
    {
        $user = Auth::user();
        return WeightLog::where('user_id', $user->id)
            ->where('log_date', $logDate)
            ->first();
    }
}
