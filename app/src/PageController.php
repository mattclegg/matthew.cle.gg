<?php

namespace {

    use SilverStripe\Assets\Filesystem;
    use SilverStripe\CMS\Controllers\ContentController;
    use MattClegg\dompdf\SS_DOMPDF;

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
            $pdf->loadHtml($this->pdfraw());
            return $pdf->stream(
                "$this->URLSegment.pdf",
                ['Attachment' => 0]
            );
        }
    }
}
