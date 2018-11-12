<?php

namespace Student\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\I18n\Validator\IsFloat;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;


class Student
{
    public $Student_ID;
    public $Student_Name;
    public $GPA;

    private $inputFilter;

    public function exchangeArray(array $data){
        $this->Student_ID = !empty($data['Student_ID'])?$data['Student_ID']:null;
        $this->Student_Name = !empty($data['Student_Name'])?$data['Student_Name']:null;
        $this->GPA = !empty($data['GPA'])?$data['GPA']:null;
    }

    public function getArrayCopy()
    {
        return [
            'Student_ID' => $this->Student_ID,
            'Student_Name' => $this->Student_Name,
            'GPA' => $this->GPA,
        ];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'Student_ID',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Student_Name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);
/*
        $inputFilter->add([
            'name' => 'GPA',
            'required' => true,
            'filters' => [
                ['name' => IsFloat::class],
            ],
        ]);
*/
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}