<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					<div class="row">
					<div class="col-lg-4 col-sm-12">Remix is our Breath !</div><div class="col-lg-8 col-sm-12"> <small>Feel the rythm of Kannada Remix Songs by our own Kannada DJs</small></div>
					</div>
				</h1>
			</div>
		</div>
	</div>
	<div style="width:100%;margin:0 auto;">
		<script class="homepage-ads"  async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- kannadaremix-homepage 2 -->
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-5981565123562520"
			 data-ad-slot="4017170685"
			 data-ad-format="auto"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<div style="width:80%;margin:0 auto;text-align: center;">
		<div class="banners_title" style="font-size:1.3em;padding:50px 0px 0px 0px;">SEARCH KANNADA REMIX PORTAL</div>
		<script>
		  (function() {
		    var cx = '015736494310638276632:dmgj9aijiko';
		    var gcse = document.createElement('script');
		    gcse.type = 'text/javascript';
		    gcse.async = false;
		    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
		    var s = document.getElementsByTagName('script')[0];
		    s.parentNode.insertBefore(gcse, s);
		  })();
		</script>
		<gcse:search></gcse:search>
	</div>
	<div class="row">
		<div class="col-lg-4 stats-block">
			<h2 class="stats-header text-muted">
				Recent Albums
			</h2>
			<ol style="padding: 0px;" class="stats-content">
			<?php for($i=0;$i<count($krmpalbums);$i++){?>
				<a href="<?=base_url().index_page();?>/songs/s_home/index/2/<?=$krmpalbums[$i]['id'];?>">
				<li>
					<?='<strong>'.$krmpalbums[$i]['albumname'].'</strong><small class="text-right text-muted"> by '.$krmpalbums[$i]['author'].'</small><hr style="margin:0px;">';?>
				</li>	
				</a>
			<?php }?>
			</ol>
		</div>
		<div class="col-lg-4 stats-block">
			<h2 class="stats-header text-muted">
				DJ Albums Top Songs
			</h2>
			
			<ol style="padding: 0px;" class="stats-content">
			<?php for($i=0;$i<count($topsongs2);$i++){?>
				<a href="#" onClick="processView.getSongUrl(<?=$topsongs2[$i]['id'];?>);">
				<li>
					<?='<strong>'.$topsongs2[$i]['name'].'</strong><small class="text-right text-muted"> by '.$topsongs2[$i]['author'].'</small><hr style="margin:0px;">';?>
				</li>	
				</a>
			<?php }?>
			</ol>
		</div>
		<div class="col-lg-4 stats-block">
			<h2 class="stats-header text-muted">
				Weekend Bash Top Songs
			</h2>
			
			<ol style="padding: 0px;" class="stats-content">
			<?php for($i=0;$i<count($topsongs1);$i++){?>
				<a href="#" onClick="processView.getSongUrl(<?=$topsongs1[$i]['id'];?>);">
				<li>
					<?='<strong>'.$topsongs1[$i]['name'].'</strong><small class="text-right text-muted"> by '.$topsongs1[$i]['author'].'</small><hr style="margin:0px;">';?>
				</li>	
				</a>
			<?php }?>
			</ol>
		</div>
	</div>
	<!--<hr />
	<div class="row form-area" >
		<div class="col-lg-6 sub-form">
			<?=isset($subscribemessage)?$subscribemessage:'';?>
			<h4 class="text-center text-muted">
				Get info on latest addition and stats
			</h4>
			<form class="form-horizontal" role="form" method="post" action="<?=base_url().index_page();?>/welcome/subscribe">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">
						Email
					</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputEmail3" required="required" name="inputEmail3" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default btn-md">
							Subscribe Me
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-6 con-form">
			<?=isset($contactmessage)?$contactmessage:'';?>
			<h4 class="text-center text-muted">
				Contact Us
			</h4>
			<form class="form-horizontal" role="form" method="post" action="<?=base_url().index_page();?>/welcome/contactus">
				<div class="form-group">
					<label for="inputEmail1" class="col-sm-2 control-label">
						Email
					</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputEmail1" required="required" name="inputEmail1" />
					</div>
				</div>
				<div class="form-group">
					<label for="contactmessage" class="col-sm-2 control-label">
						Message
					</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="contactmessage" required="required" name="contactmessage"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default btn-md">
							Send
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>-->
</div>