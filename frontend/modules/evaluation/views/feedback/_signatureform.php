<input type="hidden" id="sigId" name="sigId">
<div class="border border-secondary rounded" style="display: block; margin-left: auto; margin-right: auto;">
<canvas id="signatureform" width=760px height=300px></canvas>
</div>
<div style="overflow:auto; margin-top: 10px">
    <div style="float:right;">
        <div>
            <button type="button" class="btn btn-primary btn-lg" id="clear-signature">Clear</button>
            <button type="button" class="btn btn-success btn-lg" id="submit-signature">Ok</button>
        </div>
    </div>
</div>

<style>
   #clear-signature, #submit-signature{
        border-radius: 25px;
        width: 150px;
    }
</style>

<script>
    //signature canvas
    $(document).ready(function(){
        var canvas = document.getElementById("signatureform");
        var signaturePad = new SignaturePad(canvas);

        $('#clear-signature').on('click', function() {
            signaturePad.clear();
            document.getElementById('sigId').value = "";
            document.getElementById('feedback-signature').value = "";
            var myCanvas = document.getElementById('signature');
            myCanvas.src = '/images/tap.png';
        });

        $("body").on("touchend","#signatureform",function () {
            var canvas = document.getElementById("signatureform");
            var dataURL = canvas.toDataURL();
            document.getElementById("sigId").value = dataURL;
        });
        $("body").on("mouseup","#signatureform",function () {
            var canvas = document.getElementById("signatureform");
            var dataURL = canvas.toDataURL();
            document.getElementById("sigId").value = dataURL;
        });

        $('#submit-signature').on('click',function () {
            var myCanvas = document.getElementById('signature');
            var sigtext = document.getElementById('sigId')
            if(sigtext.value != ""){
                myCanvas.src = document.getElementById('sigId').value;
                document.getElementById("feedback-signature").value = myCanvas.src; 
                $("#modal .close").click(); 
            } 
        });
    });
 

</script>