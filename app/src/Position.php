<?php

namespace {

    use SilverStripe\Dev\Debug;
    use SilverStripe\ORM\DataObject;

    class Position extends DataObject
    {
        private static $table_name = 'Position';

        private static $db = [
            "Title" => "Text",
            "Company" => "Text",
            "Location" => "Text",
            "Date" => "Varchar(11)"
        ];

        private static $has_many = [
            "PositionDescription" => PositionDescription::class
        ];

        private static $default_sort = 'Date DESC';

        public function CompanyLogo()
        {
            return $this->renderWith(
                'logos/' .
                preg_replace(
                    '/\s+/',
                    '',
                    $this->obj('Company')->LowerCase()
                ) .
                '.svg'
            );
        }

        public function CompanyLogo64()
        {
            return 'data:image/svg+xml;base64,' . base64_encode($this->CompanyLogo());
        }
    }
}
