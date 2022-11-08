<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Ceklogin implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
      // Do something here
      if (!session('login')) {
        return redirect()->to('login');
      }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
      // Do something here
  }
}