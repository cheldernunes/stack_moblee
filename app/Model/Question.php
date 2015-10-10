<?php

App::uses('AppModel','Model');
App::import('Vendor','Solarium',array('file' => 'solarium' . DS . 'vendor' . DS . 'autoload.php'));

class Question extends AppModel{

    public $name='Question';
    public $primaryKey = 'question_id';




    public function beforeSave($options = array()) {
        if (isset($this->data['Question']['tags']) && !empty($this->data['Question']['tags'])){
            $this->data['Question']['tags'] = json_encode($this->data['Question']['tags']);
        }

        if (isset($this->data['Question']['owner']['display_name'])){
            $this->data['Question']['owner_name'] = $this->data['Question']['owner']['display_name'];
        }
        return true;
    }

    public function afterSave($created, $options = array()){

        $client = new Solarium\Client(Configure::read('solr'));
        $update = $client->createUpdate();
        $doc = $update->createDocument();
        $doc->question_id_i = $this->data['Question']['question_id'];
        $doc->title_s = $this->data['Question']['title'];
        $doc->owner_name_s = $this->data['Question']['owner_name'];
        $doc->score_i = $this->data['Question']['score'];
        $doc->creation_date_l = $this->data['Question']['creation_date'];
        $doc->link_s = $this->data['Question']['link'];
        $doc->is_answered_b = $this->data['Question']['is_answered'];
        $doc->tags_t = $this->data['Question']['tags'];
        $doc->overwrite = true;

        $update->addDocument($doc);
        $update->addCommit();
        $client->update($update);


    }

    public function truncateSolr(){
        $client = new Solarium\Client(Configure::read('solr'));
        $update = $client->createUpdate();
        $update->addDeleteQuery('*:*');
        $update->addCommit();
        $client->update($update);

    }

}