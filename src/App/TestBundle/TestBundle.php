<?php

namespace App\TestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TestBundle extends Bundle
{

    /**
     * @var array Enumeration types of question
     */
    public static $questionType = array(
        'single' => 0,
        'many' => 1,
        'text' => 2
    );

}
