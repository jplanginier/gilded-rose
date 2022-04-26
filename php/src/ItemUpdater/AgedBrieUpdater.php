<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

class AgedBrieUpdater implements ItemUpdaterInterface
{
    use DecreaseByOneItemSellInTrait;
    use IsItemExpiredTrait;

    const AGED_BRIE = 'Aged Brie';

    public function applies(Item $item): bool {
        return $item->name === self::AGED_BRIE;
    }

    public function update(Item $item): Item {
        $item = $this->decreaseItemSellInByOne($item);
        $item = $this->increaseItemQualityAndDoubleIfExpired($item);

        return $item;
    }

    private function increaseItemQualityAndDoubleIfExpired(Item $item): Item {
        $item->quality++;
        if ($this->isItemExpired($item)) {
            $item->quality++;
        }

        return $item;
    }
}