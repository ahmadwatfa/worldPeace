<?php

namespace App\Repository;

interface CustomerRepositoryInterface
{
    public function index();

    public function getUser($userId);

    public function deleteUser($userId);
}
