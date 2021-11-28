<HTML lang="eng">
<BODY>

<canvas id='before' height='400' width='400' style='border: 1px solid'></canvas>
<canvas id='after' height='400' width='400' style='border: 1px solid'></canvas>

<script>
    let canvas = document.getElementById('before');
    let ctx = canvas.getContext('2d');
    let canvas2 = document.getElementById('after');
    let ctx2 = canvas2.getContext('2d');
    let img = new Image();
    img.setAttribute('crossOrigin', '');
    img.src = 'cat.jpg';
    img.onload = function () {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        let img_data = ctx.getImageData(0, 0, canvas.width, canvas.height);
        let img_data2 = ctx2.createImageData(canvas.width, canvas.height);
        let S_x
        let S_y
        let S
        let p = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        for (let i = 0; i < canvas.height; ++i) {
            for (let j = 0; j < canvas.width; ++j) {
                for (let k = 0; k < 3; ++k) {
                    p[0] = img_data.data[4 * ((i - 1) * canvas.width + j - 1) + k];
                    p[1] = img_data.data[4 * ((i - 1) * canvas.width + j) + k];
                    p[2] = img_data.data[4 * ((i - 1) * canvas.width + j + 1) + k];
                    p[3] = img_data.data[4 * (i * canvas.width + j - 1) + k];
                    p[4] = img_data.data[4 * (i * canvas.width + j) + k];
                    p[5] = img_data.data[4 * (i * canvas.width + j + 1) + k];
                    p[6] = img_data.data[4 * ((i + 1) * canvas.width + j - 1) + k];
                    p[7] = img_data.data[4 * ((i + 1) * canvas.width + j) + k];
                    p[8] = img_data.data[4 * ((i + 1) * canvas.width + j + 1) + k];
                    S_x = (-1) * p[0] + (0) * p[1] + (1) * p[2] + (-2) * p[3] + (0) * p[4]
                        + 2 * p[5] + (-1) * p[6] + (0) * p[7] + 2 * p[8];
                    S_y = (-1) * p[0] + (-2) * p[1] + (-1) * p[2] + (0) * p[3] + (0) * p[4]
                        + (0) * p[5] + (1) * p[6] + (2) * p[7] + (1) * p[8];
                    S = Math.sqrt(S_x * S_x + S_y * S_y);
                    S < 128 ? S = 0 : S = S;
                    img_data2.data[4 * (i * canvas.width + j) + k] = S;
                }
                img_data2.data[4 * (i * canvas.width + j) + 3] = 255;
            }
        }
        ctx2.putImageData(img_data2, 0, 0);
    }
</script>
</BODY>
</HTML>