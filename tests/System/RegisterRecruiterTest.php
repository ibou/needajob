<?php

namespace App\Tests\System;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class RegisterRecruiterTest
 * @package App\Tests\System
 */
class RegisterRecruiterTest extends \App\Tests\Integration\RegisterJobSeekerTest
{
    use SystemTestTrait;
}
