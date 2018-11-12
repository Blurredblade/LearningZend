<?php
/**
 * Created by PhpStorm.
 * User: zacco
 * Date: 10/26/2018
 * Time: 10:35 AM
 */

namespace Album\Form;

use Zend\Form\Form;


class AlbumForm extends Form
{
    public function __construct($name = null){
        parent::__construct('album');

        $this->add([
            'name'=>'id',
            'type'=>'hidden',
        ]);
        $this->add([
            'name'=>'title',
            'type'=>'text',
            'options'=>[
                'label'=>'Title',
            ],
        ]);
        $this->add([
            'name'=>'artist',
            'type'=>'text',
            'options'=>[
                'label'=>'Artist',
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