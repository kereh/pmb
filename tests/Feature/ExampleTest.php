<?php


it('redirects to login page', function () {
  /** @var Tests\TestCase $this */
    $response = $this->get('/');
    $response->assertRedirect('/login');
});
