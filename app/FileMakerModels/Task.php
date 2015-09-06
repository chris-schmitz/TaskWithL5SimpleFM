<?php

namespace L5Tasks\FileMakerModels;

use L5SimpleFM\FileMakerModels\BaseModel;

class Task extends BaseModel
{
    protected $layoutName = 'web_tasks';

    public function findAllIncomplete()
    {
        $result = $this->findByFields(['complete' => '*', 'complete.op' => 'neq']);
        return $this;
    }

    public function markComplete($recid)
    {
        $result = $this->updateRecord($recid, ['complete' => 1]);
        return $this;
    }

    public function markIncomplete($recid)
    {
        $result = $this->updateRecord($recid, ['complete' => '']);
        return $this;
    }
}
