<?php

require "Deck.php";
require "Player.php";
require "Dealer.php";

class Game
{
  private int $cpu_max_total_value = 21;

  public function start(): void
  {
    // ゲーム開始のコール
    echo "ブラックジャックを開始します" . PHP_EOL;

    // デッキの作成
    $deck = new Deck();


    // Playerのターン
    $player = new Player($deck);
    $player_total_value = $player->getPlayerTotalValue();

    // 手札の合計値が$player_max_total_valueを超えていたら、Playerの負け
    if ($player->getPlayerMaxTotalValue() < $player_total_value) {
      echo "あなたの合計が" . $player->getPlayerMaxTotalValue() . "点を超えましたのでPlayerの負けです" . PHP_EOL;
      return;
    }

    // CPUのターン
    // $cpu_total_value = $cpu->getCpuTotalValue();
    // 手札の合計値が$cpu_max_total_valueを超えていたら、CPU1 or CPU2の負け

    // Dealerのターン
    $dealer = new Dealer($deck);
    $dealer_total_value = $dealer->getDealerTotalValue();
    // 手札の合計値が$dealer_max_total_valueを超えていたら、Dealerの負け
    echo "ディーラーのターンを終了します。" . PHP_EOL;


    // Player, CPU, Dealerの合計値を比較して,照射を決める
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
