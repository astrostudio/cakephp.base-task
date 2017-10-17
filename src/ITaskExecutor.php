<?php
namespace Base\Task;

interface ITaskExecutor {

    function execute($cmd);
    function kill($pid);

}