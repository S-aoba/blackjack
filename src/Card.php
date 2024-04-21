<?php

class Card
{
  private string $value;
  private string $suit;

  public function __construct(string $value, string $suit)
  {
    $this->value = $value;
    $this->suit = $suit;
  }

  public function getValue(): string
  {
    return $this->value;
  }

  public function getSuit(): string
  {
    return $this->suit;
  }
}
