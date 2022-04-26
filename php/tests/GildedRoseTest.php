<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemUpdater\AgedBrieUpdater;
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
        $items = [new Item(AgedBrieUpdater::AGED_BRIE, 10, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(6, $items[0]->quality, 'Quality does not increase on updateQuality for item "Aged Brie"');
    }

    public function testBrieItemQualityIncreaseByTwoAfterSellInExpired(): void {
        $items = [new Item(AgedBrieUpdater::AGED_BRIE, -3, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(7, $items[0]->quality, 'Quality does not increase on updateQuality for item "Aged Brie" after expired sell in');
    }

    public function testItemCantExceedMaximumQuality(): void {
        $items = [new Item(AgedBrieUpdater::AGED_BRIE, -2, GildedRose::MAXIMUM_QUALITY)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality, 'Quality can\'t be higher than maximum value for an item');
    }


    /*
     - All items have a SellIn value which denotes the number of days we have to sell the item
	- All items have a Quality value which denotes how valuable the item is
	- At the end of each day our system lowers both values for every item

Pretty simple, right? Well this is where it gets interesting:

	- "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
	- "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
	Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but
	Quality drops to 0 after the concert

We have recently signed a supplier of conjured items. This requires an update to our system:

	- "Conjured" items degrade in Quality twice as fast as normal items
     */
    // https://github.com/emilybache/GildedRose-Refactoring-Kata/blob/main/GildedRoseRequirements.txt
}
