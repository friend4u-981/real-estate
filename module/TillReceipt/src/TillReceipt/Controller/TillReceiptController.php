<?php

namespace TillReceipt\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel,
   TillReceipt\Model\TillReceipt;

class TillReceiptController extends AbstractActionController
{
	protected $tillReceipt;

    public function indexAction()
    {
    	


        //the receipt information is fetched along with the currency and discount information
    	$resultSet=$this->getTillReceipt()->getReceipt();
           

            

            $itemList=$resultSet['items'];
            $currency=$resultSet['currency'];
            
            $discount=$resultSet['discount'];

            $subTotal=$resultSet['subTotal'];
            $grandTotal=$resultSet['grandTotal'];


            //if any item found in the item list, then the subsequesnt result is received

            $noItem=1; //flag to indicate if there is any item in the list

    	   if(count($itemList)>0){

                $noItem=0; //if item found the flag is set to 0

	    	}

        return new ViewModel(

				array('noItem'=>$noItem,'itemlist'=>$itemList,'subTotal'=>$subTotal,'currency'=>$currency,'grandTotal'=>$grandTotal,'discount'=>$discount)


        	);
    }

    public function ajaxAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();

         //the receipt information is fetched along with the currency and discount information
        $resultSet=$this->getTillReceipt()->getReceipt();
           

            

            $itemList=$resultSet['items'];
            $currency=$resultSet['currency'];
            
            $discount=$resultSet['discount'];

            $subTotal=$resultSet['subTotal'];
            $grandTotal=$resultSet['grandTotal'];


            //if any item found in the item list, then the subsequesnt result is received

            $noItem=1; //flag to indicate if there is any item in the list

           if(count($itemList)>0){

                $noItem=0; //if item found the flag is set to 0

            }
 
           /* $viewModel = new ViewModel();
    $viewModel->setVariables(array('noItem'=>$noItem,'itemlist'=>$itemList,'subTotal'=>$subTotal,'currency'=>$currency,'grandTotal'=>$grandTotal,'discount'=>$discount))
              ->setTerminal(true);*/

    //return $viewModel;

$jsonModel = new JsonModel();
  $jsonModel->setVariables(array('noItem'=>$noItem,'itemlist'=>$itemList,'subTotal'=>$subTotal,'currency'=>$currency,'grandTotal'=>$grandTotal,'discount'=>$discount));

  return $jsonModel;

    }


    //function to get an instance of TillReceipt Model
    public function getTillReceipt()
     {
        //if object of TillReceipt class has not been created yet,

         if (!$this->tillReceipt) {

            //create  a new object
             $this->tillReceipt=new TillReceipt();
            
         }
         return $this->tillReceipt;
     }


}

