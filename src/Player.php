<?php

require "Calculate.php";

class Player
{
  private array $hands = [];
  private int $player_max_total_value = 21;

  public function __construct(private Deck $deck)
  {
    $this->deck = $deck;
    $this->setHands($deck->drawTwoCards());
  }

  private function setHands(array $drawCards): void
  {
    foreach ($drawCards as $card) {
      $this->displayCard($card);
      array_push($this->hands, $card);
    }
  }


  public function getHands(): array
  {
    return $this->hands;
  }

  public function getPlayerMaxTotalValue(): int
  {
    return $this->player_max_total_value;
  }

  public function getPlayerTotalValue(): int
  {

    $calculate = new Calculate();
    $total_value = 0;
    while (true) {
      $total_value = $calculate->calculateTotalValue($this->hands, 0);

      $action = $this->playerAction($total_value);

      if ($action == 'Y' || $action == 'y') {
        echo strtoupper($action) . PHP_EOL;

        $drawCard = $this->deck->drawOneCard();
        $total_value = $calculate->calculateTotalValue($drawCard, $total_value);

        if ($this->player_max_total_value < $total_value) break;

        $this->setHands($drawCard);
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

  private function displayCard(Card $card): void
  {
    $value = $card->getValue();
    $suit = $card->getSuit();

    $suit = match($suit) {
      '♠' => 'スペード',
      '♥' => 'ハート',
      '♣' => 'クローバー',
      '♦' => 'ダイヤモンド'
    };
    echo "あなたの引いたカードは" . $suit . "の" . $value . "です" . PHP_EOL;
  }
}
