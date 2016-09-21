<?php

    namespace app\models;
    use yii\db\ActiveRecord;
    
    class Customer extends ActiveRecord{
        //帮助顾客获取订单信息
        public function getOrders() {
            //$customer未声明，改为$this
            //$orders = $this->hasMany(Order::className(),['customer_id'=>'id'])->asArray()->all();//一个顾客多个订单，一对多
             $orders = $this->hasMany(Order::className(),['customer_id'=>'id'])->asArray();//属性方法那边已自动补上ll(),这边就不要了
            return $orders;
        }
    }