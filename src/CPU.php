<?php

namespace App;

use App\Calculate;

class CPU extends Role
{
  public function __construct(Deck $deck, string $role)
  {
    parent::__construct(17, $deck, $role);

    // 最初のカードを2枚取得, handsにセットする
    $this->getAndSetTwoCardsInHands();

    // 取得したカード2枚をコンソールに表示する
    $this->displayHands($role);
  }

  public function getCPUTotalValue(Calculate $calc, string $role): int
  {
    $total_value = 0;

    while (true) {
      // 現在の手札の合計を計算する
      $total_value = $this->calculateTotalValue($calc);

      echo $role . "の現在の得点は" . $total_value . "点です" . PHP_EOL;

      // 追加で一枚引く
      $drawCard = $this->deck->drawOneCard();

      // 引いたカードを表示する
      $this->displayDrawCard($drawCard, $role);

      // 手札に加える
      $this->setOneDrawCardInHand($drawCard);

      // 再度合計点を計算し直す
      $total_value = $this->calculateTotalValue($calc);

      // 手札の合計値がgetMaxTotalValueを超えていたらwhile文を抜ける
      if ($this->getMaxTotalValue() < $total_value) break;
    }

    return $total_value;
  }
}
