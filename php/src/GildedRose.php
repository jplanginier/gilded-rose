<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    const AGED_BRIE = 'Aged Brie';
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items) {
        $this->items = $items;
    }

    public function updateQuality(): void {
        foreach ($this->items as $item) {
            $this->alterItem($item);

//            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
//                if ($item->quality > 0) {
//                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
//                        $item->quality = $item->quality - 1;
//                    }
//                }
//            } else {
//                if ($item->quality < 50) {
//                    $item->quality = $item->quality + 1;
//                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
//                        if ($item->sell_in < 11) {
//                            if ($item->quality < 50) {
//                                $item->quality = $item->quality + 1;
//                            }
//                        }
//                        if ($item->sell_in < 6) {
//                            if ($item->quality < 50) {
//                                $item->quality = $item->quality + 1;
//                            }
//                        }
//                    }
//                }
//            }
//
//            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
//                $item->sell_in = $item->sell_in - 1;
//            }
//
//            if ($item->sell_in < 0) {
//                if ($item->name != 'Aged Brie') {
//                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
//                        if ($item->quality > 0) {
//                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
//                                $item->quality = $item->quality - 1;
//                            }
//                        }
//                    } else {
//                        $item->quality = $item->quality - $item->quality;
//                    }
//                } else {
//                    if ($item->quality < 50) {
//                        $item->quality = $item->quality + 1;
//                    }
//                }
//            }
        }
    }

    protected function alterItem($item) {
        $this->alterItemSellIn($item);
        $this->alterItemQuality($item);

    }

    protected function alterItemSellIn($item) {
        $item->sell_in--;
    }

    protected function alterItemQuality($item) {
        if ($item->name === self::AGED_BRIE) {
            $item->quality++;
        } else {
            $item->quality--;
        }

        if ($item->sell_in < 0) {
            $item->quality--;
        }
    }
}
