<div class="flex flex-col items-center space-y-4">
    <div>
        {!! $qrCode !!}
    </div>

    <button onclick="downloadQR()" class="px-4 py-2 bg-blue-500 text-white rounded">Download QR</button>
</div>

<script>
    function downloadQR() {
        const svg = document.querySelector('svg');
        const serializer = new XMLSerializer();
        const source = serializer.serializeToString(svg);

        const blob = new Blob([source], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(blob);

        const link = document.createElement('a');
        link.href = url;
        link.download = 'donor-qr-code.svg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
