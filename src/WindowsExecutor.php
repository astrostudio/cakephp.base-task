<?php
namespace Base\Task;

class WindowsExecutor implements ITaskExecutor {

    public function execute($cmd){
        $output= [];
        $ps=LOGS.uniqid('ps');
        exec("PsExec.exe -d $cmd 2>$ps",$output);
        $output=file($ps);

        if(!empty($output[5])){
            preg_match('/ID (\d+)/',$output[5],$matches);
            $pid=$matches[1];
        }
        else {
            $pid=0;
        }

        return($pid);
    }

    public function kill($pid){
        exec('pskill '.$pid);
    }

}