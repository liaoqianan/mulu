<?php
return array(
	//'配置项'=>'配置值'

    'SHOW_PAGE_TRACE' => true,  //打开页面跟踪信息配置
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'demo',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  't_',    // 数据库表前缀
    //替换I函数过滤方法，使用htmlpurifier的filterXSS函数
    'DEFAULT_FILTER'        =>'filterXSS',
    TMPL_PARSE_STRING =>array(
        '__PUICE__'  => '/Public/Puice',
        '__ADMIN__'   => '/Public/Admin',
        '__HOME__'    => '/Public/Home',


    ),
    'MAIL'=>array(
        'SMTP_HOST'      => "smtp.163.com",
        'SMTP_PORT'      => 25,
        'MAIL_USER'      => "qianansir@163.com",
        'MAIL_PWD'       => "qian13576823623",
        'MAIL_FROM_ADDR' => "qianansir@163.com",
        'MAIL_FROM_NAME' => "京西小商城",
    ),

   'ALIPAY' => array (
        //应用ID,您的APPID。
        'app_id' => "2016091600526959",

        //商户私钥
        'merchant_private_key' => "MIIEpQIBAAKCAQEAuCPP9ld9LZyDCwmd+3nvFCdMyz0PNBm5k2nT6q/OjWr7zPViP4GUz1wZEpf+HTRDFMo+a6ykMaVjPlxrL+4UnKOkhTxZcCiTmvY//Gwo9izGaVmtqbmw4io61dFT3XJg3asR4PyKiy4iEEjLLEpMr0PwioR4x/GUgQo0P/yCqLA1LvhObKBelw8MltiLfLEqSFA20G01bwS8XMHQ2O+Hjjyg0V2e5ucC0WYZ1jf5Le4k8vBMDApuQ/32tefRTA05lDaLAmLDMCpnjWRuEuP5wrDpwHvBmSKqj7LyeyySorkclVs5YmMj1E5QItR+hxweCxIKEdTl16yUXixPhNWdTQIDAQABAoIBAQCKyRsuDUTgws0V3Zq/9mgWpYRAznWODDGNhL7fbMBeYBsGoI/7U3xISZ7wH7S8aC6DFee0GfvrGz9QujFjf6rzYHdYoGK8oSiXLDCP3SmGWbr1nkzA1p8V50RO8aWnC1Us3YntLApz2kJ8SZEwgZOIqck7bZrnABKwq3M0IuqLnnOHQ3q1gktrxayHS8XgatPWGWWqtV6fCSjNne+JzjeC/hZGtBd85MDcByuMBICNK2gIXnSY4DnBOynglMjIC17MJpddLge5mHcLBOvmNXsydngkceg8nEXKwojDCuUfkfr+kbCRwsPMs4U9IdFIb0djpXO14/pbEkDlrHN/c03hAoGBAOfxhkjS8fRcMriO8YxLgrTqlDQW8TrIidqyMylOeDoQICPhcnp3CSdIvJlLeQ5AfKozThAfzvAfK78GIJ/hDPIAeJ4LfgDkuyugn91UTgLnKuxm1Fd8bjFOFPJFnh9TpBuf1H8uCONDHIa15Z+IFVfg+iEviF2ny8jK6yzWv8IFAoGBAMs9Bor/iCwOyqSt3zTSYtQUoDozIfghIUdI6UCrrESzn/YuvyKLnRXXKMgFXP9umL4eqqP+vaNBPlqufpokBeip1sYppAG1ArHG9x+IXMAPndZccnrdentyzKci2pQSVGvxZGF9XWaAj76XHBU4ulR7Z+CIaWCvJD+UiGLw4uipAoGAI2QnKVWGtdKbqq2lDdM3zoM8ufYGOQIAhu5KADOJBNMRFGiCH02qh+QBYyKxBguw+gd6EdvIp7sZ4bv9nmeoogSQYw093MUKCk4oFo2WmbrMQeYu4GqMJdnUOGOHDSCmGdD5i65qjMLgx21Z7E3Hc/FQOWAXXrML1UehOuZJvEECgYEAs4u5AQjYGtwCZ9N3EeofBu8l0eSkSNmz1Y7zCX/gE12AnnMTxggDAW1wCKy8SKhC5gqfg3ujutsDpAbtr2zNj4qjQ7M7wYpQ1A9K+B92mPHy5ZIMTMDm2LJFXA4tfYxn6mh53qpq3ggLdTt3wsO30LSowzKfrZtscYLdrlLSkukCgYEA3LsjakTE+/QureVToADzwGBDIVFgjX2moFMGodX1a1veh+A/AiIDVQN1VVYIlQBOlu96a/B9OC84EqGKb0DSVo3dRcA954WxF78p6uWQiffjTaiwmmlYImOPXvbKBMfm9eKeurJQahiduXyDZshSZIXV3Sbd4VN2gLycQwW5X2s=",

        //异步通知地址
        'notify_url' => "www.demo/index.php/home/cart/flow4",

        //同步跳转
        'return_url' => "www.demo/index.php/home/cart/flow5",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAznDBjn/pKcr53M8mHTCWOH3bDZ3NYTTa28EZ8pYYRdnZXdoZosGR8Zbp6itDKutF9XJvmnRcz7SiaRPjf2XHHoEr2g6vOetSDlf8UK8ONK5aHZSeyXsdlsz6jDQRfTCFYPDEQshe2Njp7F21sh6xNAOFpOV7fNADQuAVV8Y2WF2U1X7DIIynQim+XR12Fk3V6PneyhGe4emoF0FBusTOLS5ZOg40KIvgQKworHGfem8bPabKg18YNK69dfxRBBlplFdJ5fX5rTtnorzY2+Vno0NTqSgJ30iRU5JPYirqLSnWng/EA9TA0iRtRJp2lSqy6C3lz97j2Ta2Ra2pzeGPUQIDAQAB",
    ),
);