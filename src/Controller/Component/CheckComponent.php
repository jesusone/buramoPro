<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class CheckComponent extends Component
{
    /**
     * @param $id
     * @return bool
     */
    public function isId($id)
    {
        if (!isset($id) || !is_numeric($id)) {
            return false;
        }
        return true;
    }
}
