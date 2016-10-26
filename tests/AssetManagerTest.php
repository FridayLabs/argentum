<?php

class AssetManagerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $factory = new \App\Assets\AssetFactory();
        $this->manager = new \App\Assets\AssetManager();
    }

    public function testFoo()
    {
    }
}
