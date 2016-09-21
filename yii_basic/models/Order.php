<?php

    namespace app\models;
    use yii\db\ActiveRecord;
    
    class Order extends ActiveRecord{
        
        public function getCustomer() {
            
            //根据订单查询顾客信息
            return $this->hasOne(Customer::className(), ['id'=>'customer_id'])->asArray();//一个订单一个顾客，一对一
            
        }
        
    }