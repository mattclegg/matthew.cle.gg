<?php

namespace {

	use SilverStripe\CMS\Controllers\ContentController;
	use SilverStripe\View\Parsers\URLSegmentFilter;
	use SilverStripe\Control\Director;
	use Grasenhiller\WkHtmlToX\WkPdf;

	class PageController extends ContentController
	{
		private static $allowed_actions = [
			'pdf'
		];

		public function pdf() {
			$stylesheet = 'vendor/grasenhiller/silverstripe-intranet-wiki/client/css/pdf.css';

			$filter = URLSegmentFilter::create();
			$filename = $filter->filter($this->MenuTitle);
			$filename .= '__' . date('Y-m-d') . '.pdf';

			$baseUrl = Director::absoluteBaseURL();

			$pdf = new WkPdf();
			$pdf->setOption('margin-top', 20);
			$pdf->setOption('margin-bottom', 20);
			$pdf->setOption('margin-left', 15);
			$pdf->setOption('margin-right', 15);
			$pdf->setOption('user-style-sheet', $stylesheet);
			$pdf->setOption('header-html', $baseUrl . 'gh-wkhtmltox/header?template=Grasenhiller\Intranet\Wiki\Pages\Pdf\Header');
			$pdf->setOption('footer-html', $baseUrl . 'gh-wkhtmltox/footer?template=Grasenhiller\Intranet\Wiki\Pages\Pdf\Footer');
			$pdf->setOption('header-spacing', 5);
			$pdf->setOption('footer-spacing', 5);

			$html = $pdf::get_html($this, [], '', 'pdf');

			$pdf->add($html);
			$pdf->download($filename);
		}
	}
}
