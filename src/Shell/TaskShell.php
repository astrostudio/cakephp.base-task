<?php
namespace Base\Task\Shell;

use Cake\Console\Shell;

class TaskShell extends Shell{

    protected $_id=null;

    protected function _update(){
        $this->_id=!empty($this->params['task-id'])?$this->params['task-id']:0;

        return($this->Task->startup($this->_id,getmypid()));
    }

    protected function _load(){
        return($this->Task->load($this->_id));
    }

    protected function _done($result=null){
        return($this->Task->done($this->_id,$result));
    }

    protected function _fail($code=null,$error=null){
        return($this->Task->fail($this->_id,$code,$error));
    }

    protected function _kill(){
        return($this->Task->kill($this->_id));
    }

    protected function _step($progress=null,$message=null){
        return($this->Task->step($this->_id,$progress,$message));
    }

    public function initialize(){
        parent::initialize();

        $this->loadModel('Base/Task.Task');
    }

    public function getOptionParser(){
        $parser=parent::getOptionParser();
        $parser->addOption('task-id',['help'=>'TaskID']);

        return($parser);
    }

    public function startup(){
        parent::startup();

        $this->_update();
    }


}