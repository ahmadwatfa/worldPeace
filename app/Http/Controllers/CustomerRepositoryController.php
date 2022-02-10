<?php

namespace App\Http\Controllers;

use App\Repository\CustomerRepository;
use App\Repository\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerRepositoryController extends Controller
{
    private $customerRepository;
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
      return $this->customerRepository->index();

    }
    public function getUser($userId)
    {
      return $this->customerRepository->getUser($userId);

    }
    public function deleteUser($userId)
    {
      return $this->customerRepository->deleteUser($userId);

    }
}
