<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

class ItemUpdaterProvider
{
    /**
     * @var ItemUpdaterInterface[]
     */
    private $specificUpdatersCollection;

    public function __construct() {
        $this->specificUpdatersCollection = $this->buildSpecificUpdatersCollection();
    }

    public function getCorrespondingUpdater(Item $item): ItemUpdaterInterface {
        foreach ($this->specificUpdatersCollection as $updater) {
            if ($updater->applies($item)) {
                return $updater;
            }
        }

        return $this->getDefaultUpdater();
    }

    protected function getDefaultUpdater(): ItemUpdaterInterface {
        return new DefaultItemUpdater();
    }

    /**
     * @return ItemUpdaterInterface[]
     */
    private function buildSpecificUpdatersCollection(): array {
        return [
            new AgedBrieUpdater()
        ];
    }
}