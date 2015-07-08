<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample2()
	{
		$response = $this->call('GET', '/');
		$this->assertResponseOk();

	}

}
