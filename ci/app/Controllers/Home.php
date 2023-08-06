<?php

namespace App\Controllers;

class Home extends BaseController
{
public $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $logged_in = $this->session->get('admin_in');
        if ($logged_in) {
            return redirect()->to(base_url('dashboard'));
        } else {
            echo view('login');
        }
    }

    public function auth()
    {
        $incoming = $this->request->getPost();
        $incoming['password'] = sha1($incoming['password']);
        $incoming['clearance'] = 99;
        $Users = new \App\Models\Users();

        if ($udata = $Users->where($incoming)->find()) {
            $newdata = array(
                'admin' => $udata[0],
                'admin_in' => TRUE
            );
            $this->session->set($newdata);
            return redirect()->to(base_url('dashboard'));
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function register()
    {
        echo view('register');
    }

    public function postregister()
    {
        $incoming = $this->request->getPost();
        $Users = new \App\Models\Users();

        $incoming['password'] = sha1($incoming['password']);
        $incoming['bal'] = 0.0;

        if($Users->insert($incoming)){
            echo "success";
        }else{
            echo('not reg');
        }


    }

    public function logout()
    {
        $logged_in = $this->session->get('admin_in');
        if ($logged_in) {
            $this->session->destroy();
            return redirect()->to(base_url('/'));
        } else {
            echo view('login');
        }
    }

    public function dashboard()
    {  
        $logged_in = $this->session->get('admin_in');
        $udata = $this->session->get('admin');
        if ($logged_in) {
            echo view('dashboard', $udata);
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function home()
    {  
        $logged_in = $this->session->get('admin_in');
        $udata = $this->session->get('admin');
        if ($logged_in) {
            echo view('header', $udata);
            echo view('dashboard', $udata);
            echo view('footer');
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function users()
    {  
        $logged_in = $this->session->get('admin_in');
        $udata = $this->session->get('admin');
        $Users = new \App\Models\Users();
        $users = $Users->where('clearance',0)->findAll();

        if ($logged_in) {
            echo view('header', $udata);
            echo view('users', ['users'=>$users]);
            echo view('footer');
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function voucher()
    {  
        $logged_in = $this->session->get('admin_in');
        $udata = $this->session->get('admin');
        $Vouchers = new \App\Models\Vouchers();
        $vouchers = $Vouchers->findAll();

        if ($logged_in) {
            echo view('header', $udata);
            echo view('voucher', ['vouchers'=>$vouchers]);
            echo view('footer');
        } else {
            return redirect()->to(base_url('/'));
        }
    }


    public function addVoucher()
    {  
        $logged_in = $this->session->get('admin_in');
        $udata = $this->session->get('admin');
        $Vouchers = new \App\Models\Vouchers();
        $incoming = $this->request->getPost();

        if ($logged_in) {
            $incoming['used'] = 0;
            $incoming['genBy'] = $udata['email'];

            $Vouchers->insert($incoming);
            return redirect()->to(base_url('voucher'));
        } else {
            return redirect()->to(base_url('/'));
        }
    }
}
