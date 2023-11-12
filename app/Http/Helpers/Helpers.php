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
