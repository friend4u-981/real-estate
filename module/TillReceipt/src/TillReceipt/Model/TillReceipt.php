<?php

namespace TillReceipt\Model;
use Zend;


//function to get items , discount, currency values for receipt

class TillReceipt
{
   
    public function getReceipt()
    {

            //initializing the variables
            $itemList=array();
            $discount=0;
            $currency="";
            $grandTotal=0;
            $subTotal=0;    

            //the dataset.php file contains the values for itmes, price, currency and discount
            $dataSet = new Zend\Config\Config(include __DIR__ . '\dataset.php');


            if(count($dataSet)>0){

    		     $itemList=$dataSet['items'];
                 $discount=$dataSet['discount'];
			     $currency=$dataSet['currency'];
            }

			
    	

          //if there is item in the item list
     	if(count($itemList)>0){

		foreach($itemList as $item){

            //calculate the subtotal

	    		$subTotal+=(float)$item['price'];
			}

            //calculate the grand total

			$grandTotal=$subTotal-$discount;
		}



        $resultSet = array('items'=>$itemList,'subTotal'=>$subTotal,'currency'=>$currency,'grandTotal'=>$grandTotal,'discount'=>$discount);




        return $resultSet;
    }
}