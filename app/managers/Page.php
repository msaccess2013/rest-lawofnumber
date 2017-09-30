<?php

namespace App\Managers;

use App\Models\Fruit;

class Page extends Manager{
    public function index($req, $res){

        $fruit = new Fruit();

        $fruit->setName("banana");



        $vars['banana'] = $fruit->getName();
        return $this->view->render($res, 'main.phtml', $vars);
    }

    public function numbers($request, $response){
        $sql = "select pairnumber, pairtype, pairpoint, miracledesc from numbers ORDER BY pairnumberid ASC";
        $result = $this->db->prepare($sql);
        $result->execute();
        $data = $result->fetchAll(\PDO::FETCH_OBJ);

        return json_encode($data);

    }
}