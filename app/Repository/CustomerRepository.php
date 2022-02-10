<?php


namespace App\Repository;


use App\Models\User;

class CustomerRepository implements CustomerRepositoryInterface
{
    private $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {

        $user = User::get();
       return $user;
    }
    public function getUser($userId)
    {
        $user = User::where('id' , $userId)->get();
       return $user;
    }
    public function deleteUser($userId)
    {
        $user = User::where('id' , $userId)->delete();
        $users = User::get();
       return $users;
    }
}
