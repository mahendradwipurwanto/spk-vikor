<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}


	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}

	public function process(){
		$post = $this->input->post(null, TRUE);
		if(isset($post['login'])){
			$this->load->model('user_m');
			$query = $this->user_m->login($post);
			if($query->num_rows() > 0){
				$row = $query->row();
				$params = array(
					'idUser' => $row->idUser,
					'level' => $row->level
				);
				$this->session->set_userdata($params);
				
				echo "<script>
					alert('Selamat, anda berhasil login');
					window.location='".site_url('dashboard')."';
				</script>";

			} else {

				echo "<script>
					alert('Login anda gagal, username atau password salah');
					window.location='".site_url('auth/login')."';
					</script>";
			}
		}
	}

	public function logout(){
		$params = array('idUser', 'level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}

	public function register() {
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('username', 'Username','required|min_length[5]|is_unique[user.username]',
            array('min_length' => '%s minimal 5 karakter')
        );
        $this->form_validation->set_rules('password', 'Password','required|min_length[8]',
            array('min_length' => '%s minimal 8 karakter')
        );
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password','required|matches[password]|min_length[8]',
            array('min_length' => '%s minimal 8 karakter')
        );
        $this->form_validation->set_rules('email', 'Email','required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan anda isi');
        $this->form_validation->set_message('is_unique', '%s ini sudah ada, silahkan anda ganti');
        $this->form_validation->set_message('matches', '%s tidak sesuai dengan password');

		
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register');
		} else {
			$data = [
				'namaLengkap' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'email' => $this->input->post('email'),
				'jenisKelamin' => '',
				'level' => 2
			];

			$this->db->insert('user', $data);
			redirect('auth/login');
		}
	}
}
