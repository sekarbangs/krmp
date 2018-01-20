<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="left-column-list">

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row" align="center">
      <h3 align="center text-muted"><?=$listTitle;?></h3>
      <hr />
<?php 
    /******************** CATEGORIES **********************/
    if($type=='C'){
      for($i=0;$i<count($listToDisplay_Left);$i++){
?>
      <div class="col-lg-12" align="center">
        <a class="newtab-link" href="<?=base_url().index_page();?>/songs/s_home/index/<?=$listToDisplay_Left[$i]['id'];?>">
          <h4 class="alert alert-info" align="center"><?=$listToDisplay_Left[$i]['name'];?></h4>
        </a>
        </div>
<?php } // end for loop
    /******************** CATEGORIES ********************** end/
    

    /******************** ALBUMS **********************/
      }elseif($type=='A'){?>

<?php for($i=0;$i<count($listToDisplay_Left['albumInfo'][0]);$i++){
          $data[] = $listToDisplay_Left['albumInfo'][0][$i];?>          
          
    <a class="newtab-link" href="<?=base_url().index_page();?>/songs/s_home/index/<?=$data[$i]['category'].'/'.$data[$i]['id'];?>">

      <div class="col-lg-12 bg-faded">
        <!-- Album/Song Art -->
        <div class="col-lg-2"> 
          <div style="min-height:100px;text-align:left;width:100%;background: url(<?=base_url().$data[$i]['image'];?>) no-repeat;background-position:center center;background-size:contain;"></div>
        </div>
        <!-- end Album/Song Art -->
        <div class="col-lg-6">
          <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
            <strong><?=$data[$i]['name'];?></strong>
            </h6>
            <div class="panel-body text-left"><small> <span class="text text-danger">Author: -</span><?=$data[$i]['author'];?><br />
            <span class="text text-danger">Songs: -</span><?=$data[$i]['totalSongs'];?><br />
            <span class="text text-danger">Created: -</span><?=$data[$i]['created_on'];?> </small></div>
          </div>
          </div>
        </div>
        </div>
    </a>
<?php } // end for loop
  /******************** ALBUMS **********************end/
  
  /******************** SONGS **********************/
    }elseif($type=='S'){
      for($i=0;$i<count($listToDisplay_Left['songsInfo'][0]);$i++){
        $data[] = $listToDisplay_Left['songsInfo'][0][$i];
?>
    <div class="col-lg-12 col-md-12 col-sm-12">

      <!-- Serial Number starts -->
      <div class="col-xl-1 col-lg-1 col-md-1 hidden-sm hidden-xs"> 
        <span class="slNo"><?=$i+1;?></span> 
      </div>
      <!-- Serial Number ends -->
        
      <!-- song details -->
      <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-xs-11">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title text-left"><strong><?=$data[$i]['name'];?></strong></h3>
          </div><!-- end panel-heading -->
          <div class="panel-body text-left">
            <!-- songs details -->
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left"><small>
                <table class="songs-details" >
                  <tr>
                    <td title="Work of"><span class="text text-danger fa fa-user"></span> <?=$data[$i]['author'];?></td>
                  </tr>
                  <tr>
                    <td title="Total Played"><span class="text text-danger fa fa-mobile-phone"></span> <?=$data[$i]['downloaded'];?></td>
                  </tr>
                  <tr>
                    <td class="hidden-sm hidden-xs" title="Added on" ><span class="text text-danger fa fa-plus-square"></span> <?php $date = new DateTime($data[$i]['created_on']);echo $date->format('d-M-Y h:m a');?></td>
                  </tr>
              </table>
              </small>
            </div><!-- end song details -->

            <!-- Play icon -->
            <div id="blk<?=$data[$i]['id'];?>" class="text-center"> 
              <a href="#" onClick="processView.getSongUrl('<?=$data[$i]['id'];?>');" style="cursor:pointer;"> 
                <span class="fa fa-play">&nbsp;</span> 
              </a> 
            </div><!-- end play icon -->
          </div><!-- end panel-body -->
        </div>
      </div>
    </div>
<?php } // end for loop 
    }else{?>
      <h2 class="text text-danger">NO RECORDS FOUND UNDER THIS MENU</h2>
<?php }?>