<?php

namespace {

	use SilverStripe\CMS\Model\SiteTree;

	class Page extends SiteTree
	{
		private static $belongs_many_many = [
			'PositionDescription' => PositionDescription::class
		];
	}
}