<?php

App::uses('AppController','Controller');
App::import('Vendor','Stackphp',array('file' => 'stackphp' . DS . 'src' . DS . 'api.php'));


class HomeController extends AppController{

    public $components = array('Paginator', 'Flash', 'Session');

    public $uses=array('Question','Update');

    public function index(){

    }

    public function truncateSolr(){
        $this->Question->truncateSolr();
    }

    public function saveLastUpdate(){
        $this->autoRender=false;
        $this->Update->saveField('created',(new \DateTime())->format('U'));
    }

    public function sync($page=1){
        $this->response->disableCache();
        $pagesize = 98;
        $this->autoRender=false;

        API::$key = 'EvmNV9k*ytJsmqjHExCMig((';
        $stackoverflow = API::Site('stackoverflow');
        $response = $stackoverflow->Questions()->SortByCreation()->Exec()->Page($page)->PageSize($pagesize);
        $questions = array();
        while($item = $response->Fetch(FALSE))
            $questions[]['Question'] = $item;


        $result = $this->Question->saveAll($questions, array(
            'fieldList'=>array(
                'Question'=>array('is_answered','score', 'creation_date','question_id','link','title','tags',
                    'owner_name')
            )
        ));

        if ($result){
            return json_encode(array(
                'message'=>'success',
                'registros_indexados'=>$pagesize*$page));
        }else{
            return json_encode(array(
                'message'=>'error',
            ));
        }

    }


    public function getParam($param){
        if (isset($this->request->query[$param])){
            return $this->request->query[$param];
        }else{
            return NULL;
        }
    }


    public function stack_moblee(){
        $this->autoRender=false;
        $this->response->disableCache();

        $page = self::getParam('page');
        $rpp = self::getParam('rpp');
        $sort = self::getParam('sort');
        $score = self::getParam('score');

        if (empty($rpp)){
            $rpp=10;
        }

        if (empty($page)){
            $start=1;
        }else{
            $start = (($page-1)*$rpp)+1;
        }

        $keycache = md5($page.$rpp.$sort.$score);
        $result = Cache::read($keycache, 'memcache');
        if (!$result){
                    App::import('Vendor','Solarium',array('file' => 'solarium' . DS . 'vendor' . DS . 'autoload.php'));
                    $client = new Solarium\Client(Configure::read('solr'));
                    $query = $client->createSelect();
                    if ($score)
                        $query->setQuery('score_i:['.$score.' TO *]');

                    $query->setStart($start)->setRows($rpp);

                    if ($sort)
                        $query->addSort($sort, $query::SORT_ASC);

                    $resultset = $client->select($query);
                    $out = $content = array();

                    foreach ($resultset as $document) {

                        foreach($document AS $field => $value){
                            preg_match("/(.*)_/", $field, $field_out);
                            if ($field_out){
                                $content[$field_out[1]]=$value;
                            }
                            unset($content['tags']);
                            unset($content['_version']);
                        }
                        $out[]=$content;

                    }

                    $update = $this->Update->find('first',array('fields'=>array('created'),'order'=>array('created desc')));
                    $last_updated = $update['Update']['created'];
                    $result = array('last_updated'=>$last_updated, 'content'=>$out);
                    Cache::write($keycache, $result, 'memcache');

        }

        return json_encode($result);

    }


}