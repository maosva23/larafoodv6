<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase; //Deleta a base de dados sempre que faz um test
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
