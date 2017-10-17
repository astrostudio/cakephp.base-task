<?php
namespace Base\Task\Shell;

use Cake\Console\Shell;

class ExecutorShell extends Shell
{
    public function initialize(){
        parent::initialize();

        $this->loadModel('Base/Task.Task');
    }

    public function getOptionParser(){
        $parser=parent::getOptionParser();
        $parser->addSubcommands([
            'append'=>[
                'parser'=>[
                    'arguments'=>[
                        'shell'=>[
                            'required'=>true,
                            'help'=>'Shell name'
                        ],
                        'action'=>[
                            'required'=>true,
                            'help'=>'Shell action name'
                        ],
                        'param1'=>[],
                        'param2'=>[],
                        'param3'=>[],
                        'param4'=>[],
                        'param5'=>[]
                    ],
                    'options'=>[
                        'timeout'=>[
                            'short'=>'t',
                            'default'=>60,
                            'help'=>'Timeout'
                        ],
                        'step'=>[
                            'short'=>'i',
                            'default'=>5,
                            'help'=>'Step'
                        ],
                    ]
                ]
            ],
            'invoke'=>[
                'parser'=>[
                    'arguments'=>[
                        'id'=>[
                            'required'=>true,
                            'help'=>'Task ID'
                        ]
                    ],
                    'options'=>[
                        'timeout'=>[
                            'short'=>'t',
                            'default'=>60,
                            'help'=>'Timeout'
                        ],
                        'step'=>[
                            'short'=>'i',
                            'default'=>5,
                            'help'=>'Step'
                        ],
                    ]
                ]
            ],
            'launch'=>[
                'parser'=>[
                    'arguments'=>[
                        'id'=>[
                            'required'=>true,
                            'help'=>'Task ID'
                        ]
                    ],
                    'options'=>[
                        'timeout'=>[
                            'short'=>'t',
                            'default'=>60,
                            'help'=>'Timeout'
                        ],
                        'step'=>[
                            'short'=>'i',
                            'default'=>5,
                            'help'=>'Step'
                        ],
                    ]
                ]
            ]
        ]);

        return($parser);
    }

    public function append(){
        $shell=$this->args[0];
        $action=$this->args[1];
        $params=[];
        $c=count($this->args);

        if($c>2){
            for($i=2;$i<$c;++$i){
                $params[]=$this->args[$i];
            }
        }

        $task=$this->Task->append($shell,$action,$params);

        if(!$task){
            return(-1);
        }

        $this->out('Task: '.$task->id);

        return(0);
    }

    public function invoke(){
        $id=$this->args[0];
        $timeout=!empty($this->params['timeout'])?$this->params['timeout']:null;
        $step=!empty($this->params['step'])?$this->params['step']:null;

        $result=$this->Task->invoke($id,$timeout,$step);
        $this->out(json_encode($this->Task->load($id)));

        return(0);
    }

    public function launch(){
        $id=$this->args[0];
        $timeout=!empty($this->params['timeout'])?$this->params['timeout']:null;
        $step=!empty($this->params['step'])?$this->params['step']:null;

        $result=$this->Task->launch($id,$timeout,$step);

        $this->out(json_encode($result));

        return(0);
    }


}