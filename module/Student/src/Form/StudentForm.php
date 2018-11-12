<?php

namespace Student\Form;

use Zend\Form\Form;


class StudentForm extends Form
{
    public function __construct($name = null){
        parent::__construct('student');

        $this->add([
            'name'=>'Student_ID',
            'type'=>'text',
            'options'=>[
                'label'=>'ID'
            ]
        ]);
        $this->add([
            'name'=>'Student_Name',
            'type'=>'text',
            'options'=>[
                'label'=>'Name',
            ],
        ]);
        $this->add([
            'name'=>'GPA',
            'type'=>'text',
            'options'=>[
                'label'=>'GPA',
            ],
        ]);
        $this->add([
            'name'=>'submit',
            'type'=>'submit',
            'attributes'=>[
                'value'=>'Go',
                'id'=>'submitbutton',
            ],
        ]);
    }
}