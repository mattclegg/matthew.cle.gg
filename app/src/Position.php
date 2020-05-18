<?php

namespace {

	use SilverStripe\ORM\DataObject;

	class Position extends DataObject
	{
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

		function CompanyLogo() {
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
	}
}