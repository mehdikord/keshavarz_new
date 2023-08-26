<?php

function log_search_store($user_id=null,$implement_id=null,$location=null,$result=null){

    \App\Models\Search::create([
        'user_id' => $user_id,
        'implement_id' => $implement_id,
        'location' => $location,
        'result' => $result,
    ]);

}
