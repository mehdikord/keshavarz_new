<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequestSendRequest;
use App\Http\Requests\Single\SearchProvidersRequest;
use App\Interfaces\Search\SearchInterface;
use App\Models\User;
use Illuminate\Http\Request;

class SearchingController extends Controller
{
    protected SearchInterface $repository;

    public function __construct(SearchInterface $search)
    {
        $this->repository = $search;
    }


    public function search_providers(SearchProvidersRequest $request)
    {

        return $this->repository->search_providers($request);
    }

    public function provider_profile(User $user)
    {
        return $this->repository->provider_profile($user);
    }

    public function provider_gallery(User $user)
    {
        return $this->repository->provider_gallery($user);

    }

    public function search_providers_request_send(SearchRequestSendRequest $request)
    {
        return $this->repository->search_providers_request_send($request);

    }

    public function search_providers_request_users(\App\Models\Request $request)
    {
        return $this->repository->search_providers_request_users($request);
    }

    public function search_providers_request_cancel(\App\Models\Request $request)
    {
        return $this->repository->search_providers_request_cancel($request);
    }

    public function search_providers_request_get_pending()
    {
        return $this->repository->search_providers_request_get_pending();
    }
}
