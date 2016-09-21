<?php

    namespace app\controllers;
    use yii\web\Controller;
    //use yii\web\Cookie;
    use app\models\Test;
    use app\models\Customer;
    use app\models\Order;

    class HelloController extends Controller{
        
        public $layout = 'common';
        
        public function actionIndex() {
            
            //视图之布局文件
            
            //控制器1.请求
            $request = \YII::$app->request;
            //echo $request->get('id', 20);
            //echo $request->post('name', 33333);
            
            //判断请求类型的方式
            //if($request->isPost) {
                //echo 'this is get method';
            //}
            
            //echo $request->userIp;
            
            //echo 'hello world';
            
            
            //2.响应
            $res = \YII::$app->response;
            
            //$res->statusCode = '404';
            
           //$res->headers->add('pragma', 'no-cache');
           //$res->headers->set('pragma', 'max-age=5');
           //$res->headers->remove('pragma');
           
           //跳转
           //$res->headers->add('location', 'http://www.baidu.com');
           //$this->redirect('http://www.baidu.com', 302);
            
            //文件下载
            //$res->headers->add('content-disposition', 'attachment; filename="a.jpg"');
            //$res->sendFile('./robots.txt');
            
            
            //3.session处理
            //$session = \YII::$app->session;
            //$session->open();
            //判断session是否开启
            //if($session->isActive) {
                //echo 'session is active';
            //}
            
            //存放和读取及删除数据,当作对象
            //$session->set('user', '张三');
            //echo $session->get('user');
            //$session->remove('user');
            
            //当作数组
            //$session['user'] = "张三";
            //echo $session['user'];  不同浏览器不一定读得出来
            //unset($session['user']);
            
            
            //4.cookie处理
            //设置和修改数据
            //$cookies = \YII::$app->response->cookies;
            
            //$cookie_data = array('name' => 'user', 'value' => 'zhangsi');
            //$cookies->add(new Cookie($cookie_data));
            //$cookies->remove('_csrf');
            
            //获取数据
            $cookies = \YII::$app->request->cookies;
            //echo $cookies->getValue('user');
            //echo $cookies->getValue('users', 20);
            
            
            //视图1.创建2.数据传递
            //echo '';
            $hello_str = 'hello God!<script>alert(3);</script>';
            $test_arr = array(1, 2);
            //创建一个数组
            $data = array();
            //把要传递给视图的数据放到数组当中
            $data['view_hello_str'] = $hello_str;
            $data['view_test_arr'] = $test_arr;
            //return $this->renderPartial('index', $data);
            
            //视图之布局文件
            //return $this->render('about');//$content
            
            //在视图中显示另一个视图
            //return $this->renderPartial('index1');
            
            //视图之数据块
            //return $this->render('index2');
            //return $this->render('about1');
            
            
            //数据查询方法1--->Test::findBySql();
            //$id = 1;
            //$id = '1 or 1=1';//数据外露
            //$sql = 'SELECT * FROM test WHERE id=' . $id;
            //$sql = 'SELECT * FROM test WHERE id=:id';//得用占位符
            //SELECT * FROM test
            //$results = Test::findBySql($sql, array(':id'=>1 or 1=1))->all();//第二个参数为数组，防止sql注入
            //print_r($results);
            
            //数据查询方法2--->Test::find();
            //id=1
            //$results = Test::find()->where(['id'=>1])->all();
            //id>0
            //$results = Test::find()->where(['>', 'id', 0])->all();
            //id>=1&&id<=2
            //$results = Test::find()->where(['between', 'id', 1, 2])->all();
            //title like "%title1%"
            //$results = Test::find()->where(['like', 'title', 'title1'])->all();
            //内存使用量降低，方法1查询结果转化成数组
            $results = Test::find()->where(['between', 'id', 1, 2])->asArray()->all();
           
            //内存使用量降低，方法2批量查询
            foreach(Test::find()->batch(1) as $tests) {
                //print_r(count($tests));
            }//每次拿2个存放到$tests里,只能拿一次，打印出一个2;每次拿1个，能拿两次，打印出两个1;
             //print_r($results);//也跟以上共用
            
            
            //删除数据
            $results = Test::find()->where(['id'=>1])->all();
            //$results[0]->delete();
            //删除数据之捷径
            //Test::deleteAll('id>:id', array(':id'=>0));//删除id>0的数据,用占位符，第二参数为数组
            
            //增加数据
            //$test = new Test;//实例化
            //$test->id=4;
            //$test->title='title3';
            //$test->validate();//保存之前，调用，启动rules函数
            //if($test->hasErrors()) {
            //   echo 'data is error!';//验证错误
            //   die;//验证错误，结束程序，不让数据保存
            //}
            //$test->save();
        
            //修改数据
            //$test = Test::find()->where(['id'=>4])->one();
            //$test->title='title4';
            //$test->save();
            
            
            //数据关联查询
            //根据顾客查询其订单信息
            $customer = Customer::find()->where(['name'=>'zhangsan'])->one();//all()返回数组；one()返回对象 $customer为customer.php的类的实例
            //$orders = $customer->hasMany('app\models\Order',['customer_id'=>'id'])->asArray()->all();//两个参数，第二个参数注意顺序
            //$orders = $customer->hasMany(Order::className(),['customer_id'=>'id'])->asArray()->all();//改进版->封装后贴到customer活动记录里
            //$orders = $customer->getOrders();通过调用函数的方法
            //$orders = $customer->orders;//优化后，通过属性的方法，未声明的属性，php会自动调用__get()->getOrders()属性名->自动补上all()\hasMany()再返回给$orders
            //print_r($orders); 
            
            //根据订单查询顾客信息
            //$order = Order::find()->where(['id'=>1])->one();
            //$customer = $order->customer;//通过属性方法,未声明的属性，php会自动调用__get()->getOrders()属性名->自动补上one()\hasOne()再返回给$orders
            //print_r($customer);
            
            
            //关联查询结果缓存
            //$customer = Customer::find()->where(['name'=>'zhangsan'])->one();
            //$orders = $customer->orders;//select * from order where customer_id=...
            //unset($customer->orders);//数据更新后的话，要用unset()先释放下
            //$orders2 = $customer->orders;//select * from order where customer_id=...
            
            //关联查询的多次查询
            //$customers = Customer::find()->all();//不用where条件就会将用户数据全都抓取出来//select * from customer
            $customers = Customer::find()->with('orders')->all();//加上with(),参数为属性orders
            //相当于执行了select * from customer; select * from customer where customer_id in(...),表示所有顾客id的集合，而不是某个顾客；共执行两次
            foreach($customers as $customer) {
                $orders = $customer->orders;//select * from order where customer_id=...（with()就不要执行这个了），执行101次
            }
        }
        
    }