<div class="row"><p class="alert alert-info text-center">Kannada Remix Music Portal | All Rights Reserved | 2015 - <?=date('Y');?> </p></div>
</div><!-- end .container, opened in header.php -->
<div class="row" id="radiowraper" >
	<div class="controls">
      <button class="button fa fa-play"></button>
      <div class="track">
        <div class="progress"></div>
        <div class="scrubber"></div>
      </div>
    </div>
</div>
<script>var reqURI = '<?=isset($_SESSION['REQUEST_URI'])?$_SESSION['REQUEST_URI']:'';?>';</script>
<script src="<?=base_url();?>js/jquery.min.js"></script>
<script src="<?=base_url();?>js/jquery-ui.min.js"></script>
<script src="<?=base_url();?>js/bootstrap.min.js"></script>
<script src="<?=base_url();?>js/krmp.scripts.load.js"></script>
<script src="<?=base_url();?>js/krmp.scripts.js"></script>
<requesteduri><?php echo isset($_SESSION['REQUEST_URI']) ? $_SESSION['REQUEST_URI'] : '';?></requesteduri>
</html>