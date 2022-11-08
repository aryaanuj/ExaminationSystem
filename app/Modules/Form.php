<?php

namespace App\Modules;

class Form
{
   public static function getForm($data){
        return [
            'id'  => $data['id']??$data['name'],
            'name' => $data['name']??'',
            'placeholder' => $data['placeholder']??ucwords($data['name']),
            'label' => $data['label']??ucwords($data['name']),
            'grid' => $data['grid']??'col-md-4',
            'class' => $data['class']??'',
            'type' => $data['type']??'text',
            'help_text' => $data['help_text']??'',
            'required' => $data['required']??true,
            'template' => $data['template']??'input'
        ];   
   }
}
