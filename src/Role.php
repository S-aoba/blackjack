<?php

namespace App;

use App\Calculate;
use App\Deck;
use App\Card;

class Role
{
  protected array $hands = [];
  protected Deck $deck;
  protected int $max_total_value;
  protected string $role = '';

  public function __construct(int $max_total_value, Deck $deck, string $role)
  {
    $this->max_total_value = $max_total_value;
    $this->deck = $deck;
    $this->role = $role;
  }

  protected function getAndSetTwoCardsInHands(): void
  {
    $drawCards =  $this->deck->drawTwoCards();

    foreach ($drawCards as $card) {
      array_push($this->hands, $card);
    }
  }

  protected function setOneDrawCardInHand(Card $newCard): void
  {
    array_push($this->hands, $newCard);
  }

  protected function displayHands(string $role): void
  {
    $hands = $this->hands;

    // ディーラーの場合
    if ($role === 'ディーラー') {
      $card = $hands[0];
      $value = $card->getValue();
      $suit = $card->getSuit();
      $suit = $this->convertSuit($suit);
      echo $role . "の引いたカードは" . $suit . "の" . $value . "です" . PHP_EOL;
      if (count($hands) === 2) {
        echo "ディーラーの引いた2枚目のカードはわかりません" . PHP_EOL;
      }
    }
    // プレイヤー or CPUの場合
    else {
      foreach ($hands as $card) {
        $value = $card->getValue();
        $suit = $card->getSuit();
        $suit = $this->convertSuit($suit);
        echo $role . "の引いたカードは" . $suit . "の" . $value . "です" . PHP_EOL;
      }
    }
  }

  protected function displayDrawCard(Card $card, string $role): void
  {
    $value = $card->getValue();
    $suit = $card->getSuit();
    $suit = $this->convertSuit($suit);
    echo $role . "の引いたカードは" . $suit . "の" . $value . "です" . PHP_EOL;
  }


  protected function convertSuit(string $suit): string
  {
    return match ($suit) {
      '♠' => 'スペード',
      '♥' => 'ハート',
      '♣' => 'クローバー',
      '♦' => 'ダイヤモンド',
      default => 'Unknown'
    };
  }

  public function getMaxTotalValue(): int
  {
    return $this->max_total_value;
  }

  protected function calculateTotalValue(Calculate $calc)
  {
    $res = 0;

    $hands = $this->hands;
    foreach ($hands as $card) {
      $value = $card->getValue();

      $int_val = $calc->calculateTotalValue($value, $res);
      $res += $int_val;
    }

    return $res;
  }
}
