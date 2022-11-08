<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public static function getFormFields(){
        $formFields = [
            'form_field_name' => [
                'name' => 'title'
            ],
            'form_field_image' => [
                'name' => 'image',
                'type' => 'file'
            ],
            'form_field_demo' => [
                'name' => 'demo',
                'type' => 'number'
            ]
        ];

        return $formFields;
    }
}