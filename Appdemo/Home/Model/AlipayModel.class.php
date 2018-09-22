<?php
namespace Home\Model;
use Think\Model;
class AlipayModel extends Model{

    // 初始化的时候，把文件统一引入
    public function __construct(){
        // require_once './alipay/config.php';
        require_once './alipay/pagepay/service/AlipayTradeService.php';
        require_once './alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
    }
    protected $tableName = 'goods';
    // 组装HTML表单发送给支付宝
    /**
     * [pay description]
     * @param  string $out_trade_no 商户订单号
     * @param  string $subject      订单名称
     * @param  float  $total_amount 付款金额
     * @param  string $body         订单描述
     * @return [type]               [description]
     */
    public function pay($out_trade_no, $subject, $total_amount, $body=''){
        $config = C('ALIPAY');
        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);

    }

    // 接收支付宝通过post方式提交过来的数据
    public function notify_url(){
        $config = C('ALIPAY');
        // 接收post数据并开始验证数据
        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);
        // 验证成功
        if($result) {
            // 订单号
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];

            if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
                // 修改订单状态
                $data['order_status'] = 1;
                D('Order')->where("order_number='$out_trade_no'")->save( $data );
            }
            echo "success"; //请不要修改或删除
        }else {
            //验证失败
            echo "fail";

        }
    }

    // 接收支付宝get方式发送过来的数据
    public function return_url(){
        $config = C('ALIPAY');
        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        if($result) {//验证成功

            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);

            // echo "验证成功<br />支付宝交易号：".$trade_no;

            // 修改订单状态
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            $data['order_status'] = 1;
            D('Order')->where("order_number='$out_trade_no'")->save( $data );
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }

}