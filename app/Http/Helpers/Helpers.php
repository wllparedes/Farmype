<?php

use Carbon\Carbon;

function getCurrentYear()
{
    return Carbon::now('America/Lima')->format('Y');
}
