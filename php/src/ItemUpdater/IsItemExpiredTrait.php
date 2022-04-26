<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

trait IsItemExpiredTrait
{
    protected function isItemExpired(Item $item): bool {
        return $item->sell_in < 0;
    }
}