<?php

function log_search_store($user_id=null,$implement_id=null,$location=null,$result=null){

    \App\Models\Search::create([
        'user_id' => $user_id,
        'implement_id' => $implement_id,
        'location' => json_encode($location, JSON_THROW_ON_ERROR),
        'result' => $result,
    ]);

}
