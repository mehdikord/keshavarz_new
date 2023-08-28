<?php

//check user own data
function access_user_own($user_id): void
{

    if ($user_id !== auth('users')->id()){
        abort('403','access denied');
    }
}
