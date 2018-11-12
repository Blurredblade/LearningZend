<?php

namespace Student\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;
use Student\Model\StudentTable;
use Student\Form\StudentForm;
use Student\Model\Student;
use RuntimeException;

class StudentController extends AbstractActionController
{
    private $table;

    public function __construct(StudentTable $table){
        $this->table = $table;
    }

    public function indexAction(){
        return new ViewModel([
            'students' => $this->table->fetchAll(),
        ]);
    }

    public function addAction(){
        $form = new StudentForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $student = new Student();
        $form->setInputFilter($student->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $student->exchangeArray($form->getData());
        $this->table->saveStudent($student);
        return $this->redirect()->toRoute('student');
    }

    public function editAction(){
        $Student_ID = (int) $this->params()->fromRoute('id');
        try {
            $student = $this->table->getStudent($Student_ID);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('student', ['action' => 'index']);
        }

        $form = new StudentForm();
        $form->bind($student);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['Student_ID' => $Student_ID, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($student->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveStudent($student);

        return $this->redirect()->toRoute('student', ['action' => 'index']);
    }

    public function deleteAction(){
        $Student_ID = (int) $this->params()->fromRoute('id');
        if (!$Student_ID) {
            return $this->redirect()->toRoute('student');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $Student_ID = (int) $request->getPost('Student_ID');
                $this->table->deleteStudent($Student_ID);
            }

            return $this->redirect()->toRoute('student');
        }

        return [
            'Student_ID'    => $Student_ID,
            'student' => $this->table->getStudent($Student_ID),
        ];
    }

}