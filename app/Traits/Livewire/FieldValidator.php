<?php

namespace App\Traits\Livewire;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

trait FieldValidator
{
    use HasFlashMessage;

    /**
     * Validate rule to a field: required, numeric and exists in DB
     *
     * @param string $fieldName
     * @param integer $modelId
     * @param string $tableName
     * @return bool
     */
    protected function isRequiredNumericAndExists(string $fieldName, int $modelId, string $tableName): bool
    {
        $validator = Validator::make([$fieldName => $modelId,], [
            $fieldName => "required|numeric|exists:$tableName,id",
            ]);
            
        if ($validator->fails()) {
            $this->generateErrorMessage();

            return false;
        }

        return true;
    }

    /**
     * Validate rule to a field: required, string, between and unique in DB
     *
     * @param string $field Field name and column name
     * @param string $value
     * @param string $table
     * @param integer $ignoreId
     * @return boolean
     */
    public function isUnique(string $field, string $value, string $table, int $ignoreId): bool
    {
        $validator = Validator::make([$field => $value,], [
            'name' => [
                'required', 'string', 'between:3,150', 
                Rule::unique($table, $field)->ignore($ignoreId)
            ],
            ]);
            
        if ($validator->fails()) {
            $this->generateErrorMessage();

            return false;
        }

        return true;
    }

    private function generateErrorMessage(string $message = 'Please fill the form correctly.')
    {
        $this->newFlashMessage($message, 'error');
    }
}