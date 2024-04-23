<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Calculate;

class CalculateTest extends TestCase
{
  public function testCalculateAceValue(): void
  {
    require_once(__DIR__ . '/../src/Calculate.php');
    $calc = new Calculate();

    $test1 = $calc->calculateTotalValue('A', 5);

    $this->assertSame(11, $test1);
  }
}
