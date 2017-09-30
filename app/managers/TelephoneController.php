<?php
namespace App\Managers;
class TelephoneController extends Manager {

    private $phoneMiracles = array();
    private $pairArr = Array();
    private $pairsTypePoint = Array();

    private function splitPair($phoneNumber){
        if (strlen($phoneNumber) == 10 && is_numeric($phoneNumber)){
            $pairNumberArr = str_split($phoneNumber, 2);
            return $pairNumberArr;

        }
        return array("xMessage"=>"format is wrong");

    }

    private function pairsDatabase($pairs){
        foreach ($pairs as $key => $value){
                $sql = "SELECT pairnumber, pairtype, pairpoint FROM numbers WHERE pairnumber = $value";

                $result = $this->db->prepare($sql);
                $result->execute();
                $data = $result->fetch(\PDO::FETCH_OBJ);

                array_push($this->pairsTypePoint, $data);

        }

            return $this->pairsTypePoint;

    }

    public function mainTelephone($request, $response){
        $phoneNumber = $request->getAttribute('phoneNumber');

        $this->pairArr = $this->splitPair($phoneNumber);
        array_push($this->phoneMiracles, array("pairs" => $this->pairArr));

        //check count pair of number phone
        if(count($this->pairArr) == 5){
            array_push($this->phoneMiracles, array("pairTypePoint" => $this->pairsDatabase($this->pairArr)));
        }

        echo json_encode($this->phoneMiracles);

    }
}