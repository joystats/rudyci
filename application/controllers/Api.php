<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends CI_Controller {
	use REST_Controller { 
		REST_Controller::__construct as private __resTraitConstruct; 
	}

    function __construct()
    {
        parent::__construct();
		$this->__resTraitConstruct();
		$this->load->driver('cache',array('adapter' => 'apc', 'backup' => 'file'));
    }

    public function index_get()
    {
		/****method 1****/
		$this->output->cache(5); 
		$this->load->view('api');
		
		/****method 2****/
		/*$data_cache = $this->cache->get('index_cache');
		if(!$data_cache){
			$data_cache=$this->load->view('api','',true);
			$this->cache->save('index_cache', $data_cache, 300);
		}
		echo $data_cache;*/
    }
	
	function cleanCache(){
		$this->cache->clean();
	}
	
	function testCache_get(){
		$data_cache = $this->cache->get('test_cache');
		if(!$data_cache){
			echo 'Saving to the cache!<br />';
			$data_cache="This is content cache done.";
			$this->cache->save('test_cache', $data_cache, 300);
		}
		echo $data_cache;
	}
	
	public function rudy_get()
    {
        $user = [
            'name' => 'John', 
			'lastname' => 'lennon', 
			'age' => 30,
			'company' => 'Rudy Technology'
        ];
		$data_cache = $this->cache->get('rudy_cache');
		if(!$data_cache){
			$this->cache->save('rudy_cache', $user, 300);
			echo json_encode($user);
		}else{
			echo json_encode($data_cache);
		}
    }
	
	public function map_get(){
		$data_cache=$this->cache->get('map_cache');
		if(!$data_cache){
			$data_cache=$this->load->view('map','',true);
			$this->cache->save('map_cache', $data_cache, 300);
		}
		echo $data_cache;
		
	}
	
	public function find_get(){
		$q = $this->input->get('q');
		$q = strtoupper($q);
		$data_cache=$this->cache->get('find_'.md5($q));
		if(!$data_cache){
			$txt="3,5,9,15,X,Y,Z";
			$base_array=explode(",",$txt);
			
			$data_cache=array(
				"base_string"=>$txt,
				"query"=>$q,
				"found"=>in_array($q,$base_array)
			);
			$this->cache->save('find_'.md5($q),$data_cache,300);
		}
		echo json_encode($data_cache);
	}
	
	public function webhook_post(){
		/*$this->output->set_header('HTTP/1.0 200 OK');
		$this->output->set_header('HTTP/1.1 200 OK');*/
		
		/*$this->output->set_status_header(200);*/
		
		$accessToken = "Ose8km9Cu2bd/bYewJEzckYHA8Hd5LOuxccTonswQp2M7zsVMMpdNDzCrsfZkh6FZN15GRIsMyiWEzBz2YfXQWLRXXBACi87tFnNpc3QcViqTCD4Fxx/2CSpfmxMonF7aFzbxL8wIgmG3Yj3qM6RZAdB04t89/1O/w1cDnyilFU=";
		
		$content = file_get_contents('php://input');
		$response = json_decode($content, true);
		
		$header = array();
		$header[] = "Content-Type: application/json";
		$header[] = "Authorization: Bearer $accessToken";
	  
		$message = $response['events'][0]['message']['text'];

		$postData['replyToken'] = $response['events'][0]['replyToken'];
		
		if(stripos($message,"สวัสดี")!== false){
			$sms=array(
				array(
					"type"=>"text",
					"text"=> "สวัสดีครับ ผมคือ Rudy Bot."
				),
				array(
					"type"=>"text",
					"text"=> "ยินดีให้บริการสอบถามข้อมูลครับ"
				),
				array(
					"type"=>"sticker",
					"packageId"=>"11538",
					"stickerId"=>"51626503"
				)
			);
		}
		
		if(stripos($message,"ข้อมูลบริษัท")!== false){
			$sms=array(
				array(
					"type"=>"text",
					"text"=> "บริษัท Rudy เป็นบริษัทในเครือ SCG"
				),
				array(
					"type"=>"text",
					"text"=> "เราคือผู้นำ Digital Technology ที่มุ่งมั่นนำเทคโลโลยีมาเพื่อพัฒนาให้ธุรกิจก้าวหน้ามั่งคง"
				)
			);
		}
		
		$postData['messages']=$sms;
		
		$this->reply($header,$postData);
		echo "OK";
	}
	
	public function reply($header,$postData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
		
    }

}
