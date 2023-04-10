<?php

namespace {

    use SilverStripe\ORM\DataObject;

    /**
     * @method SilverStripe\ORM\DataList Pages() List of attached Pages
     */
    class PositionDescription extends DataObject
    {
        private static $table_name = 'PositionDescription';

        private static $db = [
            "Content" => "HTMLText"
        ];

        private static $has_one = [
            "Position" => Position::class
        ];

        private static $many_many = [
            "Pages" => Page::class
        ];

        public function Title()
        {
            return "{$this->PositionID} - {$this->Position()->Title} / {$this->Position()->Company}";
        }

        public function OtherPages($ignore = 0)
        {
            return $this->Pages()
                ->filter('ID:not', $ignore)
                ->sort("MenuTitle");
        }

        public function OtherPagesLimited($ignore = 0)
        {
            return $this->OtherPages($ignore)
                ->limit(7)
                ->sort("PositionDescriptionCount DESC");
        }
    }
}
