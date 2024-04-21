<?php

class Calculate
{

  public function calculateTotalValue(array $hands, int $total_value): int
  {
    foreach ($hands as $hand) {
      $value = $hand->getValue();

      if ($value == 'J' || $value == 'Q' || $value == 'K') {
        $total_value += 10;
      } else if ($value == "A") {
        $total_value += 1;
      } else {
        $total_value += intval($value);
      }
    }

    return $total_value;
  }
}
