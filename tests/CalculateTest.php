<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Calculate;

class CalculateTest extends TestCase
{
  public function testCalculateAceValue(): void
  {
    $calc = new Calculate();

    $test1 = $calc->calculateTotalValue('A', 5);

    $this->assertSame(11, $test1);
  }
}
