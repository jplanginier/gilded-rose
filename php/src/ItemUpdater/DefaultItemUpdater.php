<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

class DefaultItemUpdater implements ItemUpdaterInterface
{
    use DecreaseByOneItemSellInTrait;
    use IsItemExpiredTrait;

    public function applies(Item $item): bool {
        return TRUE;
    }

    public function update(Item $item): Item {
        $item = $this->decreaseItemSellInByOne($item);
        return $this->decreaseItemQualityAndDoubleIfExpired($item);
    }

    protected function decreaseItemQualityAndDoubleIfExpired(Item $item) {
        $item->quality--;
        if ($this->isItemExpired($item)) {
            $item->quality--;
        }
        return $item;
    }


}