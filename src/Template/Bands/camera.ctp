<style type="text/css">
#v{
    width:320px;
    height:240px;
}
#qr-canvas{
    display:none;
}
#qrfile{
    width:320px;
    height:240px;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#imghelp{
    position:relative;
    left:0px;
    top:-160px;
    z-index:100;
    font:18px arial,sans-serif;
    background:#f0f0f0;
	margin-left:35px;
	margin-right:35px;
	padding-top:10px;
	padding-bottom:10px;
	border-radius:20px;
}

#result{
    border: solid;
	border-width: 1px 1px 1px 1px;
	padding:20px;
	width:70%;
}

</style>

<?php
	echo $this->Html->script('llqrcode');
	echo $this->Html->script('webqr');
	
?>
<div class="row">
	<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="alert alert-info" role="alert">
					<strong> Welcome to the bands site!</strong> 
					Our github repo is a Star Trek reference, according to Dean Groves.
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>Scan Your Band</h1>
				<p>On <strong>desktop devices</strong>, you may use either the webcam scanner to scan you band for the QR code or upload a picture of the QR code using the image input mode. <br><br>

				On <strong>mobile devices</strong>, please use the image input mode: the 'Choose File' button will allow you to take a new picture of the code.  <br><br>

				Once your code is processed, you will be allowed to enter a comment for your specific band.
				</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12 col-sm-12">
		        <div id="main">
					<div id="mainbody">
						<table class="tsel" border="0" width="100%">
							<tr>
								<td valign="top" align="center" width="50%">
									<table class="tsel" border="0">
										<tr>
											<td>
												<?= $this->Html->image('vid.png', ['class' => 'selector', 'id' => 'webcamimg', 'onclick' => 'setwebcam()', 'align' => 'left']); ?>
											</td>
											<td>
												<?= $this->Html->image('cam.png', ['class' => 'selector', 'id' => 'qrimg', 'onclick' => 'setimg()', 'align' => 'right']); ?>
											</td>
										</tr>
										<tr>
											<td colspan="2" align="center">
												<div id="outdiv">
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="3" align="center">
									<div id="result"></div>
								</td>
							</tr>
						</table>
					</div>&nbsp;
				</div>
				<canvas id="qr-canvas" width="800" height="600"></canvas>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">load();</script>
<script type="text/javascript">

$('#result').bind('DOMNodeInserted', function(e) {
	var found = false;
	
	if(typeof event.target.tagName !== 'undefined' && event.target.tagName.toLowerCase() === 'a' && !found) {
		found = true;
	    var code_url = event.target.href; //this is the url where the anchor tag points to.
	    console.log(code_url);
	    if(code_url.indexOf("bands") > -1 && code_url.indexOf("addComment") > -1) {
		    window.location.href = code_url;
		}
	}
});

</script>