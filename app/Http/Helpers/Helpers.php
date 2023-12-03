<?php

use Carbon\Carbon;

function getCurrentYear()
{
    return Carbon::now('America/Lima')->format('Y');
}

function normalizeInputStatus($data)
{
    $data['active'] = isset($data['active']) ? 'S' : 'N';

    $data['flg_recom'] = isset($data['flg_recom']) ? 1 : 0;

    $data['status'] = isset($data['status']) ? 'S' : 'N';

    $data['flg_test_exam'] = isset($data['flg_test_exam']) ? 'S' : 'N';

    $data['flg_public'] = isset($data['flg_public']) ? 'S' : 'N';

    $data['flg_asist'] = isset($data['flg_asist']) ? 'S' : 'N';

    $data['flg_survey_course'] = isset($data['flg_survey_course']) ? 'S' : 'N';

    $data['flg_survey_evaluation'] = isset($data['flg_survey_evaluation']) ? 'S' : 'N';

    $data['assist_user'] = isset($data['assist_user']) ? 'S' : 'N';

    return $data;
}

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}

function verifyImage($file)
{
    $url = asset('storage/img/common/no-image.png');
    if ($file) {
        $url = $file->file_url == null ? $url
            : $file->file_url;

        // TARDA DEMASIADO CUANDO SON VARIAS IMÁGENES

        // $directory = (explode('/', str_ireplace(array('http://', 'https://'), '', $url)))[0];

        // if ($directory == 'localhost' || $directory == '127.0.0.1:8000') {
        //     $url = $url == null ? asset('storage/img/common/no-image.png')
        //         : $url;
        // } else {
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $url);

        //     curl_setopt($ch, CURLOPT_NOBODY, 1);
        //     curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //     $result = curl_exec($ch);
        //     curl_close($ch);
        //     if ($result == false) {
        //         $url = asset('storage/img/common/no-image.png');
        //     }
        // }
    }

    return $url;
}



function whatIsTop($quantity)
{

    return $quantity >= 10 ? 'disabled' : '';

}
function whatIsBottom($quantity)
{

    return $quantity <= 1 ? 'disabled' : '';

}


function dateDiffHumans($fecha)
{
    return Carbon::parse($fecha)->locale('es')->diffForHumans();
}

function dateFormal($fecha)
{
    return Carbon::parse($fecha)->locale('es')->isoFormat('D [de] MMMM [del] YYYY');
}

function timeFormal($fecha)
{
    return Carbon::parse($fecha)->locale('es')->isoFormat('h:mm:ss a');
}
