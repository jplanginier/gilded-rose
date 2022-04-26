<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ItemUpdater\ItemUpdaterProvider;

final class GildedRose
{
    const MAXIMUM_QUALITY = 50;
    /**
     * @var Item[]
     */
    private $items;
    /**
     * @var ItemUpdaterProvider
     */
    private $itemUpdaterProvider;

    /**
     * @param Item[] $items
     */
    public function __construct(array $items) {
        $this->items = $items;
        $this->itemUpdaterProvider = new ItemUpdaterProvider();
    }

    public function updateQuality(): void {
        foreach ($this->items as $item) {
            $item = $this->alterItem($item);

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

    protected function alterItem(Item $item) {
       $updater = $this->itemUpdaterProvider->getCorrespondingUpdater($item);
       $item = $updater->update($item);
       return $this->manageItemLimitations($item);

    }

    private function manageItemLimitations(Item $item): Item {
        $item = $this->preventItemQualityFromGoingBelowZero($item);
        $item = $this->preventItemQualityFromGoingAboveMaximum($item);
        return $item;
    }

    private function preventItemQualityFromGoingBelowZero(Item $item): Item {
        $item->quality = max($item->quality, 0);
        return $item;
    }

    private function preventItemQualityFromGoingAboveMaximum(Item $item) {
        $item->quality = min($item->quality, self::MAXIMUM_QUALITY);
        return $item;
    }
}
