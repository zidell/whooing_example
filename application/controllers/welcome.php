<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function _api_get($url, $params=array()){
		$this->curl->ssl(false);
		$this->curl->http_header('X-API-KEY:app_id='.$this->config->item('app_id').',token='.$this->session->userdata('token').',signiture='.sha1($this->config->item('app_secret').'|'.$this->session->userdata('token_secret')).',nounce='.sha1(microtime()).',timestamp='.time());
		$result = $this->curl->simple_get($url, $params);
		$result_array = unserialize($result);

		// 응답코드에 따라 대처를 다르게 하기
		switch($result_array['code']){
			case 200: // 성공
			case 204: // 성공했지만 레코드가 없음
				return $result_array;
			case 400:
				exit($result_array['message'].'<br/>'.print_r($result_array['error_parameters'], TRUE));
			case 402:
				exit('일일보고서 요청 횟수가 모두 소진. 충전 요망');
			case 405:
				// 인증토큰 만료
				$this->clear_oauth();
				break;
			case 500:
				exit('whooing.com 서버에서 응답이 없습니다.');
		}
	}

	public function index()
	{

		$data = array();

		if($this->session->userdata('user_id')){
			// 가장 기본적으로 section에 관한 정보를 요청
			$result_array = $this->_api_get('https://whooing.com/api/sections/default.serialized');
			$data['section_id'] = $result_array['results']['section_id'];

			// 항목명을 표시하기 위해서 항목 정보를 미리 요청
			// 실제 서비스에서는 이 리소스가 항상 필요하므로 자체 DB에 캐싱을 하는 것을 추천(매번 요청하면 후잉서버에 무리가 감)
			$result_array = $this->_api_get('https://whooing.com/api/accounts.serialized', array(
				'section_id' => $data['section_id']
			));
			$data['accounts'] = $result_array['results'];

			// 자산부채에 관한 api
			$result_array = $this->_api_get('https://whooing.com/api/bs.serialized', array(
				'section_id' => $data['section_id']
			));
			$data['bs'] = $result_array['results'];

			// 비용수익에 관한 api
			$result_array = $this->_api_get('https://whooing.com/api/pl.serialized', array(
				'section_id' => $data['section_id'],
				'start_date' => date('Ymd', strtotime('-1 month')),
				'end_date' => date('Ymd'),
			));
			$data['pl'] = $result_array['results'];
		}
		$this->load->view('welcome_message', $data);

	}


	function start_oauth(){
		$this->curl->ssl(false);
		// request_token 발급
		$result = $this->curl->simple_get('https://whooing.com/app_auth/request_token', array(
			'app_id' => $this->config->item('app_id'),
			'app_secret' => $this->config->item('app_secret')
		));
		$result_json = json_decode($result);
		$request_token = $result_json->token;
		$callbackuri = site_url('welcome/end_oauth');

		// authorize화면으로 사용자를 이동시키고 돌아온다
		redirect('https://whooing.com/app_auth/authorize?token='.$request_token.'&callbackuri='.$callbackuri);
	}

	function end_oauth(){
		$params = $this->input->get();

		$this->curl->ssl(false);
		// access_token 발급
		$result = $this->curl->simple_get('https://whooing.com/app_auth/access_token', array(
			'app_id' => $this->config->item('app_id'),
			'app_secret' => $this->config->item('app_secret'),
			'token' => $params['token'],
			'pin' => $params['pin']
		));
		$result_json = json_decode($result);

		$array = array(
			'token' => $result_json->token,
			'token_secret' => $result_json->token_secret,
			'user_id' => $result_json->user_id,
		);
		$this->session->set_userdata( $array );

		redirect('/');

	}

	function clear_oauth(){
		$this->session->unset_userdata('token');
		$this->session->unset_userdata('token_secret');
		$this->session->unset_userdata('user_id');
		redirect('/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */