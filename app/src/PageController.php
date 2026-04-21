<?php

namespace {

    use MattClegg\dompdf\SS_DOMPDF;

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\View\ArrayData;
    use SilverStripe\View\SSViewer;
    use SilverStripe\View\ThemeResourceLoader;

    class PageController extends ContentController
    {
        private static $allowed_actions = [
            'html',
            'pdf',
            'pdfrender'
        ];

        public function html()
        {
            return $this;
        }

        public function pdf()
        {
            return $this->renderWith('Pdf');
        }

        public function pdfrender()
        {
            $pdf = new SS_DOMPDF();
            $pdf->loadHtml($this->pdf());
            return $pdf->stream(
                "$this->URLSegment.pdf",
                ['Attachment' => 0]
            );
        }

        public function inlinecss($filename='pdf')
        {
            return file_get_contents(
                ThemeResourceLoader::inst()->findThemedCSS($filename, SSViewer::get_themes())
            );
        }

        public function Description() {
            return $this->renderWith(SSViewer::fromString($this->MetaDescription));
            //return $this->renderWith(SSViewer::fromString($this->MetaDescription') ?: Page::get_homepage()->MetaDescription));
        }
    }
}
