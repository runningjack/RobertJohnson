<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 8/6/15
 * Time: 8:56 AM
 */

class TransactionController {
    private $_params;
    public function __construct($params){
        $this->_params = $params;
    }

    public function createAction(){
        $input  = $this->_params;
        $transaction = new \models\Transaction();
        $mcypt = new \system\library\Hashing\MCrypt();

        $cusData = explode(";",$input['cusData']);
        $merchData = explode(";",$input['merchData']);
        $input['trans_amount'] = $merchData[0];
        $input['trans_id'] = $merchData[1];
        $input['merch_app_id'] = $merchData[2];


        //get merchant details
        $merchant = models\Merchant::findByAppId($merchData[3]);
        //print_r($merchant);


        $input['merch_bank_code']= $merchData[3];
        $input['merch_bank_acc'] = $merchData[4];


        $input['cus_app_id'] = $cusData[0];
        $input['cus_bank_acc'] = $cusData[2];
        $input['cus_bank_name'] = $cusData[1];
        $input['cus_bank_code']=$cusData[3];

        unset($input['controller']);
        unset($input['action']);
        unset($input['cusData']);
        unset($input['merchData']);
        foreach($input as $key=>$value){
            $transaction->$key = $value;
        }
        $transaction->created_at = date("Y-m-d H:i:s");

        // $transaction->verified = 0;
        //$merchant->verified = 0;
        $v =    new system\library\Validator\Validator( array(
            //new system\library\Validator\Validate\Unique("tran"," is already existing","transactions"),
            new system\library\Validator\Validate\Required('trans_id'," is required"),
            new system\library\Validator\Validate\Required('merch_app_id'," is required"),
            new system\library\Validator\Validate\Required("cus_app_id"," is required"),
            new system\library\Validator\Validate\Required("trans_amount"," is required"),
            new system\library\Validator\Validate\Required('cus_bank_name'," is required"),
            new system\library\Validator\Validate\Required("merch_bank_acc"," is required"),
            new system\library\Validator\Validate\Required('cus_bank_acc'," is required"),
            new system\library\Validator\Validate\Required("merch_bank_acc"," is required"),
            new system\library\Validator\Validate\Required('cus_bank_acc'," is required"),
            new system\library\Validator\Validate\Required("merch_bank_code"," is required"),
            new system\library\Validator\Validate\Required('cus_bank_code'," is required")
        ),$input);
        if($v->execute() == true){

            if($transaction->create()){

                $result                 =   array();
                $result['success']      =   true;
                $result['msg']          =   "Record Created";
                $result['id']           =   $transaction->id;
                $result['code']         =   "200";
                return $result;
            }else{
                $result                 =   array();
                $result['success']      =   false;
                $result['errmsg']       =   "Transaction could not be created";
                $result['code']         =   "501";
                //throw new \Exception("Customer could not be created"); //return "error"; //unsuccessful
                return $result;
            }
        }else{
            $v_result = $v->getErrors();
            $result                 =   array();
            $result['success']      =   false;
            $result['errmsg']       =   $v_result;
            $result['code']         =   "501";
            return $result;
        }
    }

    public function updateAction(){
        $input  = $this->_params;
        unset($input['controller']);
        unset($input['action']);
        $transaction = \models\Customer::find($input['id']);
        foreach($input as $key=>$value){
            $transaction->$key = $value;
        }
        $transaction->updated_at   =   date("Y-m-d H:i:s");
        if($transaction->update()){
            $verify = new system\library\Verify("","","",$input);
            //return $customer; //success
        }else{
            throw new \Exception("Transaction could not be updated"); //return "error"; //unsuccessful
        }
    }

    public function deleteAction($id){

    }
} 