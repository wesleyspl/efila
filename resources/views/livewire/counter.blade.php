<div>
    <button wire:click="gerarPdf">Gerar PDF</button>

    @if ($pdfContent)
        <iframe src="data:application/pdf;{{ $pdfContent }}"
                width="100%"
                height="500px">
        </iframe>
    @endif
</div>
