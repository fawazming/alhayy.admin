<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$session = session();
		$logged_in = $session->get('admin_logged_in');
		if ($logged_in) {
			return redirect()->to(base_url('dashboard'));
		} else {
			echo view('login');
		}
	}

	public function auth()
	{
		$session = session();
		$uname = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		if ($uname == 'phfogun' && $password == 'pmc2022') {
			$newdata = array(
				'admin' => $uname,
				'admin_logged_in' => TRUE
			);
			$session->set($newdata);
			return redirect()->to(base_url('dashboard'));
		} else {
			return redirect()->to(base_url('/'));
		}
	}

	public function logout()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			session()->destroy();
			return redirect()->to(base_url('/'));
		} else {
			echo view('login');
		}
	}

	public function dashboard()
	{
		// echo('dashboard');	
		$logged_in = session()->get('admin_logged_in');
		$Delegates = new \App\Models\Delegates();
		$ManualDel = new \App\Models\ManualDel();
		if ($logged_in) {

			$data = [
				'total_del' => $Delegates->whereNotIn('ref',['m'])->countAllResults(),
				'remo' => $Delegates->whereNotIn('ref',['m'])->where('lb', 'Remo')->countAllResults(),
				'egba' => $Delegates->whereNotIn('ref',['m'])->where('lb', 'Egba')->countAllResults(),
				'ijebu' => $Delegates->whereNotIn('ref',['m'])->where('lb', 'Ijebu')->countAllResults(),
				'aoo' => $Delegates->whereNotIn('ref',['m'])->where('lb', 'Adoodo')->countAllResults(),
				'others' => $Delegates->whereNotIn('ref',['m'])->where('lb', 'others')->countAllResults(),
				'male' => $Delegates->whereNotIn('ref',['m'])->where('gender', 'male')->countAllResults(),
				'female' => $Delegates->whereNotIn('ref',['m'])->where('gender', 'female')->countAllResults(),
				'psec' => $Delegates->whereNotIn('ref',['m'])->where('category', 'primary')->countAllResults(),
				'jsec' => $Delegates->whereNotIn('ref',['m'])->where('category', 'jsec')->countAllResults(),
				'ssec' => $Delegates->whereNotIn('ref',['m'])->where('category', 'ssec')->countAllResults(),
				'hi' => $Delegates->whereNotIn('ref',['m'])->where('category', 'hi')->countAllResults(),
				'workers' => $Delegates->whereNotIn('ref',['m'])->where('category', 'Workers')->countAllResults(),
				'sch_leaver' => $Delegates->whereNotIn('ref',['m'])->where('category', 'sch_leaver')->countAllResults(),
				'manual' => [
					'total_del' => $Delegates->where('ref', 'm')->countAllResults(),
					'remo' => $Delegates->where(['ref'=>'m','lb'=>'Remo'])->countAllResults(),
					'egba' => $Delegates->where(['ref'=>'m','lb'=>'Egba'])->countAllResults(),
					'ijebu' => $Delegates->where(['ref'=>'m','lb'=>'Ijebu'])->countAllResults(),
					'aoo' => $Delegates->where(['ref'=>'m','lb'=>'Adoodo'])->countAllResults(),
					'others' => $Delegates->where(['ref'=>'m','lb'=>'others'])->countAllResults(),
                    'male' => $Delegates->where(['ref'=>'m','gender'=>'male'])->countAllResults(),
					'female' => $Delegates->where(['ref'=>'m','gender'=>'female'])->countAllResults(),
                    'psec' => $Delegates->where(['ref'=>'m','category'=>'primary'])->countAllResults(),
                    'jsec' => $Delegates->where(['ref'=>'m','category'=>'jsec'])->countAllResults(),
                    'ssec' => $Delegates->where(['ref'=>'m','category'=>'ssec'])->countAllResults(),
                    'hi' => $Delegates->where(['ref'=>'m','category'=>'hi'])->countAllResults(),
                    'workers' => $Delegates->where(['ref'=>'m','category'=>'Workers'])->countAllResults(),
					'sch_leaver' => $Delegates->where(['ref'=>'m','category'=>'sch_leaver'])->countAllResults(),
				]
			];

			echo view('header');
			echo view('dashboard', $data);
			echo view('footer');
		} else {
			echo view('login');
		}
	}

	public function manual()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {

			echo view('header');
			echo view('manualUpload');
			echo view('footer');
		} else {
			echo view('login');
		}
	}

	public function manual1()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {

			echo view('header');
			echo view('manualUpload1', $this->request->getGet());
			echo view('footer');
		} else {
			echo view('login');
		}
	}

	public function manual2()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {

			$manual = new \App\Models\ManualDel();
			$incoming = $this->request->getPost();
			$res = $manual->insert($incoming);

			return redirect()->back();
		} else {
			echo view('login');
		}
	}


	public function printe()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$Delegates = new \App\Models\Delegates();

			$data = array(
				'delegates' => $Delegates->findAll(),
				'type' => 'Electronic'
			);

			echo view('header');
			echo view('print', $data);
			echo view('footer');
		} else {
			echo view('login');
		}
	}

	public function printm()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$Delegates = new \App\Models\ManualDel();

			$data = array(
				'delegates' => $Delegates->findAll(),
				'type' => 'Electronic'
			);

			echo view('header');
			echo view('print', $data);
			echo view('footer');
		} else {
			echo view('login');
		}
	}

    public function cert($name)
    {
        // var_dump($name);
        echo view('cert', ['name'=>$name]);
    }

	//--------------------------------------------------------------------

}
