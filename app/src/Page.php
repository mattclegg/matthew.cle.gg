<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Control\Director;
    use SilverStripe\Core\Config\Config;
    use SilverStripe\ORM\FieldType\DBDatetime;

    /**
     * Class Page
     *
     * @method SilverStripe\ORM\ManyManyList PositionDescription
     */
    class Page extends SiteTree
    {
        private static $db = [
            "PositionDescriptionCount" => "Int"
        ];

        private static $belongs_many_many = [
            'PositionDescription' => PositionDescription::class
        ];

        private static $default_sort = "\"URLSegment\"";

        protected function onBeforeWrite()
        {
            $this->record['PositionDescriptionCount'] = $this->PositionDescription()->count();
            parent::onBeforeWrite();
        }

        public function ExperienceYears()
        {
            return DBDatetime::create()->setValue("2006-4-30")->TimeDiffIn('years');
        }

        /**
         * @return \SilverStripe\ORM\ManyManyList
         */
        public function SortedPositionDescription()
        {
            $positionTable = Config::inst()->get(Position::class, 'table_name');
            return GroupedList::create(
                $this->PositionDescription()
                ->leftJoin($positionTable, "$positionTable.ID = PositionID")
                    ->sort("$positionTable.Date DESC")
            );
        }

        public function Tag()
        {
            if ($this->URLSegment == 'home') {
                return 'web';
            } else {
                return $this->URLSegment;
            }
        }

        public function PDFLink($action = null)
        {
            return FilesystemPublisher::pathToFilename($this->URLSegment);
        }

        public function StaticLink($action = null)
        {
            $link = parent::Link($action);
            if ($link == '/') {
                return $link;
            } else {
                return rtrim($link, "/") . ".html";
            }
        }

        public function urlsToCache()
        {
            $links = [
                Director::absoluteURL($this->Link('pdf')) => 1
            ];

            if ($this->URLSegment == 'home') {
                $links = array_merge($links, [
                    Director::absoluteURL($this->Link()) => 0
                ]);
            } else {
                $links = array_merge($links, [
                    Director::absoluteURL($this->Link('html')) => 0,
                ]);
            }
            

            return $links;
        }
    }
}
