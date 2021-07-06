<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

abstract class BaseFeatureTestCase extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
}
