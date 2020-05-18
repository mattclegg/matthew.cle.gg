<?php

namespace {

	use SilverStripe\ORM\DataObject;

	/**
	 * @method SilverStripe\ORM\DataList Pages() List of attached Pages
	 */
	class PositionDescription extends DataObject
	{
		private static $db = [
			"Content" => "HTMLText"
		];

		private static $has_one = [
			"Position" => Position::class
		];

		private static $many_many = [
			"Pages" => Page::class
		];

		function OtherPages($ignore = 0) {
			return $this->Pages()->filter('ID:not', $ignore);
		}
	}
}