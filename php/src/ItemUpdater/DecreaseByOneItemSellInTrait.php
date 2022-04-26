<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

trait DecreaseByOneItemSellInTrait
{
    protected function decreaseItemSellInByOne($item): Item {
        $item->sell_in--;
        return $item;
    }
}