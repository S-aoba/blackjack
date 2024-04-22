<?php

require "Role.php";

class Player extends Role
{
  public function __construct(Deck $deck)
  {
    parent::__construct(21, $deck);

    // 最初のカードを2枚取得, handsにセットする
    $this->getAndSetTwoCardsInHands();

    // 取得したカード2枚をコンソールに表示する
    $this->displayHands('あなた');
  }

  public function getPlayerTotalValue(Calculate $calc): int
  {
    $total_value = 0;

    while (true) {
      // 現在の手札の合計を計算する
      $total_value = $this->calculateTotalValue($calc);

      // ユーザーのアクションを受け取る。Yならカードを一枚引く, nならwhile文を抜ける。
      $action = $this->playerAction($total_value);

      // ユーザーの選択したactionを表示する
      echo strtoupper($action) . PHP_EOL;

      // Y or n であれば、大文字小文字どちらでもOKにする
      if ($action == 'Y' || $action == 'y') {

        // 追加で一枚引く
        $drawCard = $this->deck->drawOneCard();

        // 引いたカードを表示する
        $this->displayDrawCard($drawCard, 'あなた');

        // 手札に加える
        $this->setOneDrawCardInHand($drawCard);

        // 再度合計点を計算し直す
        $total_value = $this->calculateTotalValue($calc);

        // 手札の合計値がgetMaxTotalValueを超えていたらwhile文を抜ける
        if ($this->getMaxTotalValue() < $total_value) break;

      } else if ($action == 'n' || $action == 'N') {
        echo "あなたのターンを終了します" . PHP_EOL;
        break;
      } else {
        echo "不正な値が入力されました。再度入力し直してください" . PHP_EOL;
      }
    }

    return $total_value;
  }

  private function playerAction(int $total_value): string
  {
    echo "あなたの現在の得点は" . $total_value . "点です。" . " カードを引きますか？ (Y/n) ";
    return trim(fgets(STDIN));
  }
}
