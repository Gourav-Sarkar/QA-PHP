<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/journal.php';
require_once 'Abstracts/AbstractController.php';

/**
 * Description of JournalController
 *
 * @author gourav sarkar
 */
class JournalController extends AbstractController {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->model = new Journal();

        $this->view->addTemplate('journal');
        if (!$this->isAjax) {
            $this->view->setWrapper("JournalApp");
        }
    }

    public function launch() {

        echo $this->view->render();
    }

    public function addEntry() {
        $this->model->setContent($_POST['content']);
        $this->model->setTime();
        $this->model->setIP();
        $this->model->setInvisible(FALSE);
        $this->model->setPassCode($_POST['passkey']);

        /*
         * User must attatch one emotion atleast
         */
        $this->model->addEmotion(explode(',', $_POST['emotions']));
        $this->model->addTag(explode(',',$_POST['tags']));

        $this->model->create();

        $this->view->addModel($this->model->xmlSerialize());

        //var_dump($this->view);

        echo $this->view->render();
    }

    public function openToday() {
        $journal = new Journal();
        //Change contentStorage to accomodate type of object it can store
        $journalStore = Journal::listing($journal, array('time' => 'today'));

        $this->view->addModel($journalStore->xmlSerialize());
        echo $this->view->render();
    }

}

?>
