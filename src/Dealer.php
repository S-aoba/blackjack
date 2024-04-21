<?php

class Dealer
{
  private array $hands = [];
  private int $dealer_max_total_value = 17;

  public function __construct(private Deck $deck)
  {
    $this->deck = $deck;
    $this->setHands($deck->drawTwoCards());
  }

  private function setHands(array $drawCards): void
  {
    $this->displayCard($drawCards[0]);
    foreach ($drawCards as $card) {
      array_push($this->hands, $card);
    }
  }

  public function getHands(): array
  {
    return $this->hands;
  }

  public function getDealerMaxTotalValue(): int
  {
    return $this->dealer_max_total_value;
  }
  public function getDealerTotalValue(): int

  {
    $calculate = new Calculate();
    $total_value = 0;

    while (true) {
      $total_value = $calculate->calculateTotalValue($this->hands, 0);

      echo "ディーラーの現在の現在の得点は" . $total_value . "点です" . PHP_EOL;
      $drawCard = $this->deck->drawOneCard();
      $total_value = $calculate->calculateTotalValue($drawCard, $total_value);

      if ($this->dealer_max_total_value < $total_value) break;

      $this->setHands($drawCard);
    }

    return $total_value;
  }

  private function displayCard(Card $card): void
  {
    $value = $card->getValue();
    $suit = $card->getSuit();

    $suit = match ($suit) {
      '♠' => 'スペード',
      '♥' => 'ハート',
      '♣' => 'クローバー',
      '♦' => 'ダイヤモンド'
    };
    echo "ディーラーの引いたカードは" . $suit . "の" . $value . "です" . PHP_EOL;
  }
}
