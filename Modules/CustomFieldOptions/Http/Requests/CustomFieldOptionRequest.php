<?php

namespace Modules\CustomFieldOptions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

/**
 * Class CustomFieldOptionRequest.
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
                'product_id' => ['required', 'exists:products,id'],
                'custom_field_id' => ['required', 'exists:custom_fields,id'],
                'additional_price' => ['required', 'numeric', 'max:1e7', 'min:1'],
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
                'product_id' => ['required', 'exists:products,id'],
                'custom_field_id' => ['required', 'exists:custom_fields,id'],
                'additional_price' => ['required', 'numeric', 'max:1e7', 'min:1'],
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
        return trans('custom_field_options::custom_field_options.attributes');
    }
}
