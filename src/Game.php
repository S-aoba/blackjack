<?php

require "Deck.php";
require "Player.php";
require "Dealer.php";
require "Calculate.php";

class Game
{
  private int $cpu_max_total_value = 21;

  public function start(): void
  {
    // ゲーム開始のコール
    echo "ブラックジャックを開始します" . PHP_EOL;

    $deck = new Deck();

    $calc = new Calculate();

    // Playerのターン
    $player = new Player($deck);

    $dealer = new Dealer($deck);

    $player_total_value = $player->getPlayerTotalValue($calc);

    // 手札の合計値が$player_max_total_valueを超えていたら、Playerの負け
    if ($player->getMaxTotalValue() < $player_total_value) {
      echo "あなたの合計が" . $player->getMaxTotalValue() . "点を超えましたのであなたの負けです" . PHP_EOL;
      return;
    }

    // CPUのターン
    // $cpu_total_value = $cpu->getCpuTotalValue();
    // 手札の合計値が$cpu_max_total_valueを超えていたら、CPU1 or CPU2の負け

    // Dealerのターン
    $dealer_total_value = $dealer->getDealerTotalValue($calc);
    echo "ディーラーの合計が" . $dealer->getMaxTotalValue() . "点を超えましたのでディーラーのターンを終了します。" . PHP_EOL;

    // Player, CPU, Dealerの合計値を比較して,勝者を決める
    $this->calculateWinnerByClosestTo21($player_total_value, $dealer_total_value);
    echo "ブラックジャックを終了します";
  }

  private function calculateWinnerByClosestTo21(int $player_total, int $dealer_total)
  {
    $dealerDiff = abs(21 - $dealer_total);
    $playerDiff = abs(21 - $player_total);

    echo "あなたの合計点: " . $player_total . PHP_EOL;
    echo "ディーラーの合計点: " . $dealer_total . PHP_EOL;

    if ($dealerDiff < $playerDiff) {
      echo "ディーラーの勝利です。" . PHP_EOL;
    } elseif ($playerDiff < $dealerDiff) {
      echo "あなたの勝利です！" . PHP_EOL;
    } else {
      echo "両者同じくらい21点に近いため、引き分けです。" . PHP_EOL;
    }
  }
}


$game = new Game();
$game->start();
