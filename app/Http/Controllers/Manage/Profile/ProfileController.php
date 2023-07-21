<?php

namespace App\Http\Controllers\Manage\Profile;

use App\Http\Controllers\Controller;
use App\Interfaces\Profile\ProfileInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileInterface $repository;
    public function __construct(ProfileInterface $profile)
    {
        $this->repository = $profile;
    }

    public function me()
    {
        return $this->repository->manage_me();
    }
}
