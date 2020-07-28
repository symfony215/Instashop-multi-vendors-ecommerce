<?php

namespace Modules\CustomFieldOptions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

/**
 * Class CustomFieldRequest
 * @package Modules\CustomFieldOptions\Http\Requests
 */
class CustomFieldOptionRequest extends FormRequest
{
    /**
     * Determine if the supervisor is authorized to make this request.
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
        if ($this->isMethod('POST')) {
            return $this->createRules();
        } else {
            return $this->updateRules();
        }
    }

    /**
     * Get the create validation rules that apply to the request.
     *
     * @return array
     */
    public function createRules()
    {
        return RuleFactory::make(
            [
                '%name%' => ['required', 'string'],
                'store_id' => ['required', 'exists:stores,id'],
                'category_id' => ['required', 'exists:categories,id'],
                'type' => ['required', 'string', 'max:30', 'min:1'],
            ]
        );
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @return array
     */
    public function updateRules()
    {
        return RuleFactory::make(
            [
                '%name%' => ['required', 'string'],
                'store_id' => ['required', 'exists:stores,id,' . $this->route('product')->id],
                'category_id' => ['required', 'exists:categories,id,' . $this->route('product')->id],
                'type' => ['required', 'string', 'max:30', 'min:1'],

            ]
        );
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('custom_fields::custom_fields.attributes');
    }

}
