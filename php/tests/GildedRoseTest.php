<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testCommonItemSellInDecreaseAfterADay(): void {
        $items = [new Item('common', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->sell_in, 'Sell in does not decrease on updateQuality for a common item');
    }

    public function testCommonItemQualityDecreaseByOneAfterADay(): void {
        $items = [new Item('common', 10, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(4, $items[0]->quality, 'Quality does not decrease on updateQuality for a common item');
    }

    public function testCommonItemQualityDecreaseByTwoAfterADayWhenSellInExpired(): void {
        $items = [new Item('common', 0, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(3, $items[0]->quality, 'Quality does not decrease by 2 on updateQuality for a common item with expired sell in');
    }

    public function testItemCantHaveNegativeQuality(): void {
        $items = [new Item('common', -2, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality, 'Quality can\'t be negative for an item');
    }

    public function testBrieItemQualityIncreaseAfterADay(): void {
        $items = [new Item('Aged Brie', 10, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(6, $items[0]->quality, 'Quality does not increase on updateQuality for item "Aged Brie"');
    }


    // https://github.com/emilybache/GildedRose-Refactoring-Kata/blob/main/GildedRoseRequirements.txt
}
