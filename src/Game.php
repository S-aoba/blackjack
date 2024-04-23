<?php

require_once '../vendor/autoload.php';

use App\Deck;
use App\Calculate;
use App\Player;
use App\Dealer;
use App\CPU;

class Game
{
  public function start(): void
  {
    // ゲーム開始のコール
    echo "ブラックジャックを開始します" . PHP_EOL;

    $deck = new Deck();

    $calc = new Calculate();

    // Playerのターン
    $player = new Player($deck, 'あなた');

    $cpu1 = new CPU($deck, 'CPU1');
    $cpu2 = new CPU($deck, 'CPU2');

    $dealer = new Dealer($deck, 'ディーラー');

    $player_total_value = $player->getPlayerTotalValue($calc);

    // 手札の合計値が$player_max_total_valueを超えていたら、Playerの負け
    if ($player->getMaxTotalValue() < $player_total_value) {
      echo "あなたの合計が" . $player->getMaxTotalValue() . "点を超えましたのであなたの負けです" . PHP_EOL;
      return;
    }

    // CPU1のターン
    // CPUの挙動を考える必要があるが、一旦ディーラーと同じ動きにしておく。
    // TODO: CPUの動きのアルゴリズムを考える。
    $cpu1_total_value = $cpu1->getCpuTotalValue($calc, 'CPU1');
    // 手札の合計値が$cpu1_max_total_valueを超えていたら、CPU1の負け
    // if ($cpu1->getMaxTotalValue() < $cpu1_total_value) {
    //   echo "CPU1の合計が" . $cpu1->getMaxTotalValue() . "点を超えましたのでCPU1の負けです" . PHP_EOL;
    //   return;
    // }

    // CPU1のターン
    $cpu2_total_value = $cpu2->getCpuTotalValue($calc, 'CPU2');
    // 手札の合計値が$cpu2_max_total_valueを超えていたら、CPU2の負け
    // if ($cpu2->getMaxTotalValue() < $cpu2_total_value) {
    //   echo "CPU2の合計が" . $cpu2->getMaxTotalValue() . "点を超えましたのでCPU2の負けです" . PHP_EOL;
    //   return;
    // }

    // Dealerのターン
    $dealer_total_value = $dealer->getDealerTotalValue($calc);
    echo "ディーラーの合計が" . $dealer->getMaxTotalValue() . "点を超えましたのでディーラーのターンを終了します。" . PHP_EOL;

    // Player, CPU, Dealerの合計値を比較して,勝者を決める
    $this->calculateWinnerByClosestTo21($player_total_value, $dealer_total_value, $cpu1_total_value, $cpu2_total_value);
    echo "ブラックジャックを終了します";
  }

  private function calculateWinnerByClosestTo21(int $player_total, int $dealer_total, int $cpu1_total, int $cpu2_total): void
  {
    $dealerDiff = abs(21 - $dealer_total);
    $playerDiff = abs(21 - $player_total);
    $cpu1Diff = abs(21 - $cpu1_total);
    $cpu2Diff = abs(21 - $cpu2_total);

    echo "あなたの合計点: " . $player_total . PHP_EOL;
    echo "ディーラーの合計点: " . $dealer_total . PHP_EOL;
    echo "CPU1の合計点: " . $cpu1_total . PHP_EOL;
    echo "CPU2の合計点: " . $cpu2_total . PHP_EOL;

    $minDiff = min($dealerDiff, $playerDiff, $cpu1Diff, $cpu2Diff);

    if ($minDiff == $dealerDiff) {
      echo "ディーラーの勝利です。" . PHP_EOL;
    } elseif ($minDiff == $playerDiff) {
      echo "あなたの勝利です！" . PHP_EOL;
    } elseif ($minDiff == $cpu1Diff) {
      echo "CPU1の勝利です！" . PHP_EOL;
    } else {
      echo "CPU2の勝利です！" . PHP_EOL;
    }
  }
}


$game = new Game();
$game->start();
