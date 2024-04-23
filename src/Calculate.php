<?php

namespace App;

class Calculate
{
  public function calculateTotalValue(string $value, int $total_value): int
  {
    if ($value == 'J' || $value == 'Q' || $value == 'K') {
      return 10;
    } else if ($value == 'A') {
      return $this->calculateAceValue($total_value);
    } else {
      return intval($value);
    }
  }

  private function calculateAceValue(int $total_value): int
  {
    // 合計値に1 または 11をそれぞれ足す
    $add_one = $total_value + 1;
    $add_eleven = $total_value + 11;

    // どちらを足しても21を超える場合は、1を返す
    if (21 < $add_one && 21 < $add_eleven || 21 < $add_one || 21 < $add_eleven) return 1;

    // 21以内で最大となる方を値として返す
    $add_one_diff = abs(21 - $add_one);
    $add_eleven_diff = abs(21 - $add_eleven);

    if ($add_one_diff < $add_eleven_diff) {
      return 1;
    } else if ($add_eleven_diff < $add_one_diff) {
      return 11;
    } else {
      // $add_one_diff と $add_eleven_diff が等しい場合、11を優先的に返す
      return 11;
    }
  }
}
