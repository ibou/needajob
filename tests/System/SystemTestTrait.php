<?php


namespace App\Tests\System;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

trait SystemTestTrait
{
    /**
     * @param array $options
     * @param array $server
     * @return KernelBrowser
     */
    public static function createClient(array $options = [], array $server = []): KernelBrowser
    {
        return WebTestCase::createClient(["environment" => "system"]);
    }
    
}
