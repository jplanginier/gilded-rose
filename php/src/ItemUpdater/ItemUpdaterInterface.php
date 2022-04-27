<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

interface ItemUpdaterInterface
{
    public function applies(Item $item): bool;

    public function update(Item $item): Item;
}