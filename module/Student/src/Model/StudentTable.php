<?php

namespace Student\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class StudentTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll(){
        return $this->tableGateway->select();
    }

    public function getStudent($Student_ID){
        $Student_ID = (int) $Student_ID;
        $rowset = $this->tableGateway->select(['Student_ID' => $Student_ID]);
        $row = $rowset->current();
        if(!$row){
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $Student_ID
            ));
        }
        return $row;
    }

    public function saveStudent(Student $student){
        $data = [
            'Student_ID' => $student->Student_ID,
            'Student_Name' => $student->Student_Name,
            'GPA' => $student->GPA,
        ];

        $Student_ID = (int) $student->Student_ID;

        if(!$this->getStudent($Student_ID)){
            $this->tableGateway->insert($data);
        }

        $this->tableGateway->update($data, ['Student_ID' => $Student_ID]);
    }

    public  function deleteStudent($Student_ID){
        $this->tableGateway->delete(['Student_ID' => (int) $Student_ID]);
    }

}