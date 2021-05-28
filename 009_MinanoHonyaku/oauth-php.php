<?php
    include("oauth-php/library/OAuthStore.php");
     include("oauth-php/library/OAuthRequester.php");
   

    define("NAME","sfujimura");
    define("KEY","dda220ec1381a7b8729b4b6a392ea6780609e14e0");
    define("SECRET","c9948efc8aa0dfa1f813516f197f1f7d");
    define("URL","https://mt-auto-minhon-mlt.ucri.jgn-x.jp/api/mt/generalNT_ja_en/");

    $options=array("consumer_key"=>KEY,"consumer_secret"=>SECRET);
    OAuthStore::instance("2Leg",$options);

    $method="POST";
    $params=array(
        "key"=>KEY,
        "name"=>NAME,
        "text"=>"今日は福井で仕事だー、お腹すいたなー、今日のご飯はかつ丼にしようっと"
    );

    
        $request=new OAuthRequester(URL,$method,$params);
        $result=$request->doRequest();

        print_r($result);
    