<?php

namespace App\Modules;

class Form
{
   public static function getForm($data){
        return [
            'id'                => $data['id']??$data['name'],
            'name'              => $data['name']??'',
            'placeholder'       => $data['placeholder']??ucwords($data['name']),
            'label'             => $data['label']??ucwords($data['name']),
            'grid'              => $data['grid']??'col-md-4 col-12',
            'class'             => $data['class']??'',
            'type'              => $data['type']??'text',
            'help_text'         => $data['help_text']??'',
            'required'          => $data['required']??true,
            'template'          => $data['template']??'input',
            'max'               => $data['max'] ?? '',
            'readonly'          => $data['readonly']?? false,
            'value'             => $data['value'] ?? '',
            'disabled'          => $data['disabled'] ?? false,
            'multiple'          => $data['multiple'] ?? false,
            'options'           => $data['options'] ?? [],
            'info_text'         => $data['info_text'] ?? null,
            'attributes'        => $data['attributes'] ?? [],
            'parent_attributes' => $data['parent_attributes'] ?? [],
            'parent_id'         => $data['parent_id'] ?? null,
            'character_count'   => $data['character_count'] ?? '255',
        ];   
   }
}
