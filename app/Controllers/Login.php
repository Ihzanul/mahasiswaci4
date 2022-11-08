<?php 

namespace App\Controllers;

class Login extends BaseController {

  public function __construct()
  {
    $this->db = \Config\Database::connect();
  }

  public function index() {
    return view('login/index');
  }

  // public function test() {
  //   echo password_hash('password', PASSWORD_BCRYPT);
  // }

  public function cekuser() {
    if($this->request->isAJAX()) {
      $userid = $this->request->getVar('userid');
      $pass = $this->request->getVar('pass');

      $validation = \Config\Services::validation();

      $valid = $this->validate([
        'userid' => [
          'label' => 'ID User',
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Tidak Boleh Kosong'
          ]
        ],
        'pass' => [
          'label' => 'Password',
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Tidak Boleh Kosong'
          ]
        ]
      ]);

      if(!$valid) {
        $msg = [
          'error' => [
            'userid' => $validation->getError('userid'),
            'password' => $validation->getError('pass'),
          ]
        ];
      } else {
        $query_cekuser = $this->db->query("SELECT * FROM users JOIN levels ON levelid=userlevelid WHERE userid='$userid'");

        $result = $query_cekuser->getResult();

        if(count($result)>0) {
          $row = $query_cekuser->getRow();
          $password_user = $row->userpass;
          
          if (password_verify($pass, $password_user)) {
            //buat session
            $simpan_session = [
              'login' => true,
              'iduser' => $userid,
              'namauser' => $row->usernama,
              'idlevel' => $row->userlevelid,
              'namalevel' => $row->levelnama
            ];
            $this->session->set($simpan_session);

            $msg = [
              'sukses' => [
                'link' => '/mahasiswa'
              ]
            ];
          } else {
            $msg = [
              'error' => [
                'password' => 'Maaf Password Yang Anda Masukan Salah!'
              ]
            ];  
          }

        } else {
          $msg = [
            'error' => [
              'userid' => 'Maaf ID User Tidak Ditemukan'
            ]
          ];
        }
      }

      echo json_encode($msg);
    }
  }

  public function keluar() {
    $this->session->destroy();
    return redirect()->to('login');
  }

}

?>