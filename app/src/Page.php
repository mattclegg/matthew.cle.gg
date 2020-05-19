<?php

namespace {

	use SilverStripe\CMS\Model\SiteTree;

	class Page extends SiteTree
	{
		private static $belongs_many_many = [
			'PositionDescription' => PositionDescription::class
		];

		function Link($action = null)
		{
			$link = parent::Link($action);
			if ($link == '/') {
				return $link;
			} else {
				return $link . ".html";
			}
		}
	}
}