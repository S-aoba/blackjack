<?php

namespace App;

use App\Card;

class Deck
{
  /**
   * @var Card[]
   */
  private array $cardList;


  public function __construct()
  {
    // cardListを生成する
    $this->cardList = $this->generateDeck();
    // cardListをシャッフルする
    $this->shuffleDeck();
  }

  /**
   * @return Card[]
   */
  private function generateDeck(): array
  {
    // 絵柄の配列
    $suits = ['♠', '♣', '♦', '♥'];
    $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    $deck = [];

    foreach ($suits as $suit) {
      foreach ($values as $value) {
        $deck[] = new Card($value, $suit);
      }
    }

    return $deck;
  }

  private function shuffleDeck(): void
  {
    shuffle($this->cardList);
  }

  /**
   * @return Card[]
   */
  public function drawTwoCards(): array
  {
    $drawNum = 2;

    $drawCardList = [];

    // $this->cardListの先頭から$drawNumの枚数分drawCardListに追加する。その際、$this->cardListから削除もする
    for ($i = 0; $i < $drawNum; $i++) {
      array_push($drawCardList, $this->cardList[0]);
      array_shift($this->cardList);
    }

    return $drawCardList;
  }

  public function drawOneCard(): Card
  {
    return array_shift($this->cardList);
  }

  /**
   * @return Card[]
   */
  public function getDeck(): array
  {
    return $this->cardList;
  }
}
