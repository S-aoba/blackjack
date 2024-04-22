<?php
class Calculate
{
  public function calculateTotalValue(string $value): int
  {
      if ($value == 'J' || $value == 'Q' || $value == 'K') {
        return 10;
      } else if ($value == 'A') {
        return 1;
      } else {
        return intval($value);
      }
  }

  private function calculateAceValue(int $total_value): int
  {
    $add_one = $total_value + 1;
    $add_eleven = $total_value + 11;

    if (21 < $add_one) {
      return $add_one;
    }

    $add_one_diff = abs(21 - $add_one);
    $add_eleven_diff = abs(21 - $add_eleven);

    if ($add_one_diff < $add_eleven_diff) {
      return $add_one;
    } else if ($add_eleven_diff < $add_one_diff) {
      return $add_eleven;
    }
  }
}
